<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\Images;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brands::all();
        return view('products.form', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), ['name' => 'required|unique:products,name', 'price' => 'required', 'brand_id' => 'required']);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = $request->all();
        $data['slug'] = Str::slug($data['name']);
        $data['status'] = 1;
        $restul = Products::create($data);
        if(Cache::has(env('KEY_PRODUCTS_LIST')))
            Cache::forget(env('KEY_PRODUCTS_LIST'));
        if($request->hasFile('images')) {
            $this->setMedia($request->file('images'), $restul->id);
        }
        return redirect()->route('backend.products.edit', ['product' => $restul->id])->with('status', 'Created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Products::where(['slug' => $slug])->first();
        if(!$product) return redirect('404');
        return view('frontend.products.detail', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Products::find($id);
        $brands = Brands::all();
        return view('products.form', compact('brands', 'product'));
    }

    /**
     * set image
     */
    public function setMedia($images, $product_id) {
		if (isset($images)) {
			foreach ($images as $file) {
				if ($file->isValid()) {
					$extension = $file->getClientOriginalExtension();
					$name = $file->getClientOriginalName();
                    $name = str_replace($extension, '', $name);
					$name = Str::slug($name, '-');
					$fileName = $name . '-' . time() . '.' . $extension;
                    $path = "public/media";
					$path = Storage::putFileAs($path, $file, $fileName);
					Images::create([
						'image' => $path,
						'product_id' => $product_id,
						'name' => $name,
					]);
				}
			}
		}
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = validator($request->all(), ['name' => 'required']);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = [
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'special_price' => $request->get('special_price'),
            'description' => $request->get('description'),
            'slug' => Str::slug($request->get('name')),
            'brand_id' => $request->get('brand_id'),
            'sort' => $request->get('sort'),
        ];
        Products::where(['id' => $id])->update($data);
        if(Cache::has(env('KEY_PRODUCTS_LIST')))
            Cache::forget(env('KEY_PRODUCTS_LIST'));
        if($request->hasFile('images')) {
            $this->setMedia($request->file('images'), $id);
        }
        return redirect()->route('backend.products.edit', ['product' => $id])->with('status', 'Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Products::find($id)->delete();
        Cache::forget(env('KEY_PRODUCTS_LIST'));
        return response(['success' => true]);
    }

    public function lists($slug = null){
        if($slug) {
            $brand = Brands::where(['slug' => $slug])->first();
            if(!$brand) return redirect('404');
            $products = Products::where(['brand_id' => $brand->id])->paginate(20);
        } else {
            $products = Products::paginate(20);
        }
        return view('frontend.products.list', compact('products'));
    }
}

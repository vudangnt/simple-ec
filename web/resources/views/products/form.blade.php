@extends('layout')
@section('title', 'Product form')
@push('script')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#idDescription'
        });
    </script>
@endpush
@php
    $action = isset($product) ? route('backend.products.update', ['product' => $product->id]) : route('backend.products.store');
@endphp
@section('content')
<form method="POST" action="{{$action}}" enctype="multipart/form-data">
    @csrf
    @if (isset($product))
        <input type="hidden" name="_method" value="PUT">
    @endif
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @foreach ($errors->all() as $message)
                <div class="alert alert-danger">{{ $message }}</div>
            @endforeach
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="d-grid gap-2 d-md-flex justify-content-md-end sticky-top">
                <a href="{{route('backend.products.index')}}" class="btn btn-info">Back</a>
                <button class="btn btn-primary">Save</button>
                @if (isset($product))
                <a href="{{route('backend.products.create')}}" class="btn btn-success">Create</a>
                @endif
            </div>
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label for="idName" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="idName" value="{{isset($product) ? $product->name : old('name')}}">
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="idPrice" class="form-label">Price</label>
                    <input type="number" step="any" class="form-control" name="price" id="idPrice" value="{{isset($product) ? $product->price : old('price')}}">
                </div>
                <div class="col-12 mb-3">
                    <label for="idSpecialPrice" class="form-label">Special price</label>
                    <input type="number" step="any" class="form-control" name="special_price" id="idSpecialPrice" value="{{isset($product) ? $product->special_price : old('special_price')}}">
                </div>
                <div class="col-12 mb-3">
                    <label for="idDescription" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="idDescription" rows="5" style="height: 350px;"> {{isset($product) ? $product->description : old('description')}}</textarea>
                </div>
                <div class="col-lg-6 mb-3">
                    <label class="form-label">Brands</label>
                    <select class="form-select" name="brand_id" aria-label="Default select example">
                        @foreach ($brands as $brand)
                            <option value="{{$brand->id}}" {{isset($product) && $product->brand_id == $brand->id ? 'selected' : ''}}>{{$brand->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="idSort" class="form-label">Position</label>
                    <input type="number" class="form-control" name="sort" id="idSort" value="{{isset($product) ? $product->sort : old('sort')}}">
                </div>
                <div class="col-12 mb-3">
                    <label for="idImage" class="form-label">Images</label>
                    <div class="fallback">
                        <input name="images[]" type="file" multiple />
                    </div>
                </div>
                @if (isset($product) && $product->images)
                    @include('includes.images', ['images' => $product->images])
                @endif
            </div>
        </div>
    </div>
</form>
@endsection

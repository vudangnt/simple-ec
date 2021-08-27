@extends('frontend.app')
@section('title', 'Product list')
@section('content')
    @if ($products)
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4">
        @foreach ($products as $product)
        @php
            $img = $product->images()->first();
        @endphp
        <div class="col">
            <div class="image mb-3">
                @if ($img)
                    <a href="{{route('frontend.product.detail', ['slug' => $product->slug])}}">
                        <img src="{{images($img->image)}}" alt="{{$img->name}}" class="img-thumbnail">
                    </a>
                @endif
            </div>
            <div class="desc pb-3">
                <div class="title mb-1"><a href="{{route('frontend.product.detail', ['slug' => $product->slug])}}">{{$product->name}}</a></div>
                <div class="price mb-1"><span class="me-3">Price: <span> <span class="fw-bolder"> &euro; {{$product->price}}</span></div>
                <button class="btn btn-primary btn-add-to-cart" data-id="{{$product->id}}">Add to cart</button>
            </div>
        </div>
        @endforeach

    </div>
    @endif

@endsection

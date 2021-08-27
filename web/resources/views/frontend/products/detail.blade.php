@extends('frontend.app')
@section('title', 'Product detail')
@push('style')
    <link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
@endpush
@push('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
@endpush
@section('content')
@php
    $firstImage = $product->images()->first();
@endphp
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('frontend.home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('frontend.brand', ['slug' => $product->brand->slug])}}">{{$product->brand->name}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$product->name}}</li>
        </ol>
    </nav>

    <div class="row row-cols-md-2">
        @if ($firstImage)
        <div class="col">
            <div class="fotorama" data-nav="thumbs">
                @foreach ($product->images as $img)
                    <img src="{{images($img->image)}}" alt="{{$img->name}}">
                @endforeach
            </div>
        </div>
        @endif

        <div class="col">
            <h1 class="title">{{$product->name}}</h1>
            <div class="d-flex justify-content-end">
                <div class="price fw-bold {{($product->special_price && $product->special_price > 0) ? 'me-3  text-decoration-line-through' : ''}}">&euro; {{$product->price}}</div>
                @if ($product->special_price && $product->special_price > 0)
                    <div class="special-price fw-bold">&euro; {{$product->special_price}}</div>
                @endif
            </div>
            <div class="brand mb-3"><strong>Brand:</strong> <a href="{{route('frontend.brand', ['slug' => $product->brand->slug])}}">{{$product->brand->name}}</a></div>

            <div class="d-flex justify-content-between mt-3">
                <div class="qty d-flex justify-content-between align-items-center">
                    <span>Quantity: </span>
                    <div class="qty-input d-flex align-items-center ms-3">
                        <button class="decrease border border-light pe-auto">-</button>
                        <input type="text" class="form-control text-center size-sm" name="qty" value="1" data-id="{{$product->id}}">
                        <button class="increase border border-light pe-auto">+</button>
                    </div>

                </div>
                <button class="btn btn-primary btn-add-to-cart" data-id="{{$product->id}}">Add to cart</button>
            </div>
            <br/>

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="des-tab1" data-bs-toggle="tab" data-bs-target="#tab1" type="button" role="tab" aria-controls="tab1" aria-selected="true">Description</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="des-tab2" data-bs-toggle="tab" data-bs-target="#tab2" type="button" role="tab" aria-controls="tab2" aria-selected="false">Delivery</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="des-tab3" data-bs-toggle="tab" data-bs-target="#tab3" type="button" role="tab" aria-controls="tab3" aria-selected="false">Guarantees Payment</button>
                </li>
            </ul>
            <div class="tab-content pt-3" id="myTabContent">
                <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="des-tab1">
                    {!!$product->description!!}
                </div>
                <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="des-tab2">
                    Delivery infomations
                </div>
                <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="des-tab3">
                    Warranty infomations
                </div>
            </div>

        </div>
    </div>
@endsection

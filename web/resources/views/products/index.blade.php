@extends('layout')
@section('title', 'Product')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-grid gap-2 mb-3 d-md-flex justify-content-md-end">
            <a href="{{route('backend.products.create')}}" class="btn btn-primary" type="button">Create</a>
        </div>
        @include('includes.table-list', ['columns' => ['name', 'price'], 'items' => $products, 'module' => 'product'])
    </div>
</div>

@endsection

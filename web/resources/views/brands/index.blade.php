@extends('layout')
@section('title', 'List brands')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-grid gap-2 mb-3 d-md-flex justify-content-md-end">
            <a href="{{route('backend.brands.create')}}" class="btn btn-primary me-md-2" type="button">Create</a>
        </div>
        @include('includes.table-list', ['columns' => ['name'], 'items' => $brands, 'module' => 'brand'])
    </div>
</div>

@endsection

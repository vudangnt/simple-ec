@extends('layout')
@section('title', 'Create brands')
@section('content')
@php
    $action = isset($brand) ? route('backend.brands.update', ['brand' => $brand->id]) : route('backend.brands.store');
@endphp
<form method="POST" action="{{$action}}" enctype="multipart/form-data">
    @csrf
    @if (isset($brand))
        <input type="hidden" name="_method" value="PUT">
    @endif
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="d-grid gap-2 d-md-flex justify-content-md-end sticky-top">
                <a href="{{route('backend.brands.index')}}" class="btn btn-info">Back</a>
                <button class="btn btn-primary">Save</button>
                @if (isset($brand))
                <a href="{{route('backend.brands.create')}}" class="btn btn-success">Create</a>
                @endif
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <label for="idName" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="idName" value="{{isset($brand) ? $brand->name : old('name')}}">
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

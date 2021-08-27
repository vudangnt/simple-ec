@extends('layout')
@section('title', 'Login')
@push('script')
<script>
    $(function() {
        $('#staticBackdrop').modal('show');
    })
</script>
@endpush
@section('content')
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
            <div class="container-fluid">
                <form method="POST" action="{{route('login.login')}}">
                    @csrf
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="row mb-3">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" value="{{old('email')}}" id="inputEmail3">
                        <div class="form-text">Email: admin@gmail.com</div>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" id="inputPassword3">
                        <div class="form-text">Password: admin@123</div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </form>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection

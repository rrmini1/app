@extends('layouts/commonMaster' )

@section('layoutContent')

@if($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible" role="alert">
            {{ $error }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endforeach
@endif
<!-- Content -->
@yield('content')
<!--/ Content -->

@endsection

@extends('layouts/blankLayout')

@section('title', 'Landing page')

@section('page-style')
  @vite([
  'resources/assets/vendor/scss/pages/page-auth.scss'
  ])
@endsection

@section('content')
  <x-navbar/>
@endsection

@extends('layouts/blankLayout')

@section('title', 'Forgot Password Basic - Pages')

@section('page-style')
    @vite([
      'resources/assets/vendor/scss/pages/page-auth.scss'
    ])
@endsection

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">

                <!-- Forgot Password -->
                <div class="card px-sm-6 px-0">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mb-6">
                            <a href="{{url('/')}}" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">@include('_partials.macros',["width"=>25,"withbg"=>'var(--bs-primary)'])</span>
                                <span class="app-brand-text demo text-heading fw-bold">{{ config('variables.templateName') }}</span>
                            </a>
                        </div>
                        <!-- /Logo -->

                        @if (session('status'))
                          <div class="mb-4 font-medium text-sm text-success">
                            {{ session('status') }}
                          </div>
                        @endif

                        <h4 class="mb-1">{{__('auth.forgotPassword.title')}} 🔒</h4>
                        <p class="mb-6">{{__('auth.forgotPassword.subtitle')}}</p>
                        <form id="formAuthentication" class="mb-6" action="{{route('password.email')}}" method="POST">
                            @csrf
                            <div class="mb-6">
                                <label for="email" class="form-label">{{__('auth.email')}}</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="{{__('auth.enterEmail')}}" autofocus>
                            </div>
                            <button class="btn btn-primary d-grid w-100">{{__('auth.forgotPassword.send')}}</button>
                        </form>
                        <div class="text-center">
                            <a href="{{route('login')}}" class="d-flex justify-content-center">
                                <i class="bx bx-chevron-left scaleX-n1-rtl me-1"></i>
                              {{__('auth.forgotPassword.back')}}
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /Forgot Password -->
            </div>
        </div>
    </div>
@endsection

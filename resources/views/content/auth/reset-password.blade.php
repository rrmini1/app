@extends('layouts/blankLayout')

@section('title', 'Reset password - Pages')

@section('page-style')
    @vite([
      'resources/assets/vendor/scss/pages/page-auth.scss'
    ])
@endsection


@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Reset-password Card -->
                <div class="card px-sm-6 px-0">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mb-6">
                            <a href="{{url('/')}}" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">@include('_partials.macros',["width"=>25,"withbg"=>'var(--bs-primary)'])</span>
                                <span class="app-brand-text demo text-heading fw-bold">{{config('variables.templateName')}}</span>
                            </a>
                        </div>
                        <!-- /Logo -->

                        <form id="formResetPassword" class="mb-6" action="{{route('password.update')}}" method="POST">
                            @csrf
                            <div class="mb-6">
                                <label for="email" class="form-label">{{__('auth.email')}}</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="{{__('auth.enterEmail')}}">
                            </div>
                            <div class="mb-6 form-password-toggle">
                                <label class="form-label" for="password">{{__('auth.register.password')}}</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>

                            <div class="mb-6 form-password-toggle">
                                <label class="form-label" for="password">{{__('auth.register.confirm_password')}}</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="hidden"
                                       name="token"
                                       value="{{ request()->route('token') }}">
                            </div>

                            <button type="submit" class="btn btn-primary d-grid w-100">
                                {{__('auth.resetPassword.resetPassword')}}
                            </button>
                        </form>
                        <div class="text-center">
                            <a href="{{route('login')}}" class="d-flex justify-content-center">
                                <i class="bx bx-chevron-left scaleX-n1-rtl me-1"></i>
                                {{__('auth.forgotPassword.back')}}
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Reset-password Card -->
            </div>
        </div>
    </div>
@endsection

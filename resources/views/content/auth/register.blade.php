@extends('layouts/blankLayout')

@section('title', 'Register Basic - Pages')

@section('page-style')
    @vite([
      'resources/assets/vendor/scss/pages/page-auth.scss'
    ])
@endsection


@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register Card -->
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
                        <h4 class="mb-1">{{__("auth.register.title")}} 🚀</h4>
                        <p class="mb-6">{{__('auth.register.subtitle')}}</p>

                        <form id="formAuthentication" class="mb-6" action="{{url('/')}}" method="GET">
                            <div class="mb-6">
                                <label for="username" class="form-label">{{__('auth.register.name')}}</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="{{__('auth.register.enterName')}}" autofocus>
                            </div>
                            <div class="mb-6">
                                <label for="email" class="form-label">{{__('auth.register.email')}}</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="{{__('auth.register.enterEmail')}}">
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

                            <div class="my-8">
                                <div class="form-check mb-0 ms-2">
                                    <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms">
                                    <label class="form-check-label" for="terms-conditions">
                                        {{__('auth.register.agree')}}
                                        <a href="javascript:void(0);">{{__('auth.register.policy')}}</a>
                                    </label>
                                </div>
                            </div>
                            <button class="btn btn-primary d-grid w-100">
                              {{__('auth.register.signUp')}}
                            </button>
                        </form>

                        <p class="text-center">
                            <span>{{__('auth.register.hasAccount')}}</span>
                            <a href="{{route('login')}}">
                                <span>{{__('auth.register.signIn')}}</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- Register Card -->
            </div>
        </div>
    </div>
@endsection

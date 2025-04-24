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
                        <h4 class="mb-1">{{__('auth.verify.title')}} &nbsp; ✉️</h4>
                        <p class="mb-6">{{__('auth.verify.subtitle', ['email' => $user->email])}}</p>
                        @if (session('status') == 'verification-link-sent')
                            <div class="mb-4 font-medium text-sm text-success">
                                A new email verification link has been emailed to you!
                            </div>
                        @endif
                        <form action="/email/verification-notification" method="post">
                            @csrf
                            <input type="hidden" id="email" name="email" value="{{ $user->email }}">
                            <p class="mb6">{{__('auth.verify.question')}} &nbsp;
                                <button type="submit">{{__('auth.verify.resend')}}</button>
                            </p>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

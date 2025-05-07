@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Account')

@section('page-script')
    @vite(['resources/assets/js/pages-account-settings-account.js'])
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="nav-align-top">
                <ul class="nav nav-pills flex-column flex-md-row mb-6">
                    <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-sm bx-user me-1_5"></i> Account</a></li>
                </ul>
            </div>
            <div class="card mb-6">
                <!-- Account -->
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-6 pb-4 border-bottom">
                        <img src="{{asset('assets/img/avatars/1.png')}}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
                        <div class="button-wrapper">
                            <label for="upload" class="btn btn-primary me-3 mb-4" tabindex="0">
                                <span class="d-none d-sm-block">{{__('user.upload')}}</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
                            </label>
                            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                <i class="bx bx-reset d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">{{__('user.reset')}}</span>
                            </button>

                            <div>Allowed JPG, GIF or PNG. Max size of 800K</div>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-4">
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger">{{ __($error) }}</div>
                        @endforeach
                    @endif
                    <form id="formAccountSettings" method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <div class="row g-6">
                            <div class="col-md-6">
                                <label for="firstName" class="form-label">{{__('user.name')}}</label>
                                <input class="form-control" type="text" id="firstName" name="name" autofocus />
                            </div>
                            <div class="col-md-6">
                                <label for="last_name" class="form-label">{{__('user.lastname')}}</label>
                                <input class="form-control" type="text" name="last_name" id="last_name"  />
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">{{__('user.email')}}</label>
                                <input class="form-control" type="text" id="email" name="email" placeholder="john.doe@example.com" />
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="phoneNumber">{{__('user.phone')}}</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" id="phoneNumber" name="phone" class="form-control" placeholder="+7 900 000 0111"/>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="phoneNumber">{{__('auth.register.password')}}</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password"/>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="phoneNumber">{{__('auth.register.confirm_password')}}</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password"/>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="language" class="form-label">Language</label>
                                <select id="language" class="select2 form-select">
                                    <option value="">Select Language</option>
                                    <option value="en">English</option>
                                    <option value="ru">Russian</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="currency" class="form-label">Currency</label>
                                <select id="currency" class="select2 form-select">
                                    <option value="">Select Currency</option>
                                    <option value="usd">USD</option>
                                    <option value="euro">Euro</option>
                                    <option value="rub">RUB</option>
                                    <option value="bitcoin">Bitcoin</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="btn btn-primary me-3">{{__('user.save')}}</button>
                            <button type="reset" class="btn btn-outline-secondary">{{__('user.cancel')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

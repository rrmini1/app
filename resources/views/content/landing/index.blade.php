@extends('layouts/blankLayout')

@section('title', 'Landing ')

@section('content')
    <nav class="layout-navbar container shadow-none py-0">
      <div class="navbar navbar-expand-lg landing-navbar border-top-0 px-4 px-md-8">
        <a class="navbar-brand" href="javascript:void(0)">RRMINI</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="javascript:void(0)">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0)">Link</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="javascript:void(0)">Action</a></li>
                <li><a class="dropdown-item" href="javascript:void(0)">Another action</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="javascript:void(0)">Something else here</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="javascript:void(0)" tabindex="-1">Disabled</a>
            </li>
          </ul>
          <ul class="navbar-nav ms-lg-auto">
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                <i class="tf-icons navbar-icon ri-user-line me-1"></i>
                Profile
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('dashboard') }}" class="nav-link">
                <i class="tf-icons navbar-icon ri-dashboard-line me-1"></i>
                {{__('Dashboard')}}
              </a>
            </li>
            @guest
            <li class="nav-item">
              <a href="{{route('login')}}" class="nav-link">
                <i class="tf-icons navbar-icon ri-login-box-line me-1"></i>
                Login
              </a>
            </li>
            @endguest
            @auth
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link">
                  <i class="tf-icons navbar-icon ri-logout-box-line me-1"></i>
                  Logout
                </a>
              </li>
            @endauth
          </ul>
        </div>
      </div>
    </nav>

@endsection

@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Account')

@section('page-script')
    @vite(['resources/assets/js/pages-account-settings-account.js'])
@endsection

@section('content')
    <div class="card mb-6">
        <div class="card-body">
            <div class="row justify-content-start">
                @if($project->image)
                    <img src="{{Storage::disk('public')->url($project->image)}}" alt="project-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
                @else
                    <img src="{{asset('assets/img/avatars/1.png')}}" alt="project-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
                @endif
            </div>
            <div class="row justify-content-end">
                <div class="col-md-auto align-self-end">
                    <a class="btn btn-primary me-3" href="{{ route('projects.edit', ['project' => $project->id]) }}">{{__('menu.edit')}}</a>
                </div>
            </div>
            <h4 class="card-title mb-1"> {{__('menu.project')}}: "{{$project->name}}"</h4>
            <p class="card-text">
                {{ $project->description }}
            </p>
            <p class="card-text">
                ID: {{ $project->id }}
            </p>
            <h5>{{__('menu.developers')}}:</h5>
            @foreach($project->users()->role('developer')->get() as $user)
                <p>{{$user->name}}</p>  <br>
            @endforeach
            <h5>{{__('menu.clients')}}:</h5>
            @foreach($project->users()->role('client')->get() as $user)
                <p>{{$user->name}}</p>  <br>
            @endforeach
        </div>
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-3"></div>--}}
{{--                <div class="col-9">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body">--}}
{{--                            <ul style="overflow: auto; height: 300px;">--}}
{{--                                <li>--}}
{{--                                    <p class="nav-align-right">hkjqwhdkh</p>--}}
{{--                                </li>--}}
{{--                                <li><p>hkjqwhdkh</p></li>--}}
{{--                                <li><p>hkjqwhdkh</p></li>--}}
{{--                                <li><p>hkjqwhdkh</p></li>--}}
{{--                                <li><p>hkjqwhdkh</p></li>--}}
{{--                                <li><p>hkjqwhdkh</p></li>--}}
{{--                                <li><p>hkjqwhdkh</p></li>--}}
{{--                                <li><p>hkjqwhdkh</p></li>--}}
{{--                                <li><p>hkjqwhdkh</p></li>--}}
{{--                                <li><p>hkjqwhdkh</p></li>--}}
{{--                                <li><p>hkjqwhdkh</p></li>--}}
{{--                                <li><p>hkjqwhdkh</p></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                        <form class="p-5">--}}
{{--                            <input type="text" name="" id="">--}}
{{--                            <button type="submit" class="btn btn-primary btn-sm">--}}
{{--                                <span class="align-middle">Send </span>--}}
{{--                                <i class="bx bx-paper-plane"></i>--}}
{{--                            </button>--}}
{{--                        </form>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
@endsection

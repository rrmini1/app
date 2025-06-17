@extends('layouts/contentNavbarLayout')

@section('title', 'Create project')

@section('page-script')
    @vite(['resources/assets/js/pages-account-settings-account.js'])
@endsection

@section('content')

<div class="card mb-6">
    <!-- Project -->
    <!-- Project description-->
    <div class="card-body pt-4">
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{ __($error) }}</div>
            @endforeach
        @endif
        <form id="formAccountSettings" method="POST" action="{{ route('projects.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="">
                <div class="d-flex align-items-start align-items-sm-center gap-6 pb-4 border-bottom">
                    <img src="{{asset('assets/img/avatars/1.png')}}" alt="project-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
                    <div class="button-wrapper">
                        <label for="upload" class="btn btn-primary me-3 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">{{__('user.upload')}}</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input type="file" id="upload" name="image" class="account-file-input" hidden accept="image/png, image/jpeg" />
                        </label>
                        <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                            <i class="bx bx-reset d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">{{__('user.reset')}}</span>
                        </button>

                        <div>Allowed JPG, GIF or PNG. Max size of 800K</div>
                    </div>
                </div>
            </div>

            <div class="row g-6">
                <div class="col-md">
                    <label for="firstName" class="form-label">{{__('project.name')}}</label>
                    <input class="form-control" type="text" id="firstName" name="name" autofocus />
                </div>

            </div>
            <div class="row g-6">
                <div class="col-md">
                    <label for="basic-default-message" class="col-sm-2 col-form-label">{{__('project.description')}}</label>
                    <textarea id="basic-default-message"
                              class="form-control"
                              placeholder="{{__('project.description')}}"
                              name="description" autofocus ></textarea>
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="btn btn-primary me-3">{{__('project.save')}}</button>
                <button type="reset" class="btn btn-outline-secondary">{{__('project.cancel')}}</button>
            </div>
        </form>
    </div>
    <!-- end Project description-->
    <!-- Developers  -->
    <div class="card">
        <div class="row card-header border-bottom mx-0 px-3">
            <div class="d-md-flex justify-content-between align-items-center col-md-auto me-auto">
                <h5 class="card-title mb-0">Developers:</h5>
            </div>
            <div class="d-flex  align-items-center col-md-auto flex-wrap align-content-end">
                <div class="align-self-end">
                    <button type="submit" class="btn btn-success me-3" disabled data-bs-toggle="modal" data-bs-target="#basicModal"><i class="bx bx-plus"></i>{{__('project.add')}}</button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col mb-4">
                                            <label for="smallSelect" class="form-label">Small select</label>
                                            <select id="smallSelect" class="form-select form-select-sm" name="user_id">
                                                @foreach($developers as $user)
                                                    <option
                                                        value="{{ $user->id }}">{{ $user->name .' '. $user->email }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add Developer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                </tbody>
            </table>
        </div>
    </div>
    <!-- end Developers -->
</div>

@endsection

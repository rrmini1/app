@extends('layouts/contentNavbarLayout')

@section('title', 'Edit project - Account')

@section('page-script')
    @vite(['resources/assets/js/pages-account-settings-account.js'])
@endsection

@section('content')
    <div class="card mb-6">
        <!-- Project description-->
        <div class="card-body pt-4">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{ __($error) }}</div>
                @endforeach
            @endif
            <form
                id="formAccountSettings"
                method="POST"
                action="{{ route('projects.update', ['project' => $project]) }}"
                enctype="multipart/form-data">

                @csrf
                @method('put')

                <div class="">
                    <div class="d-flex align-items-start align-items-sm-center gap-6 pb-4 border-bottom">
                        @if($project->image)
                            <img src="{{Storage::disk('public')->url($project->image)}}" alt="project-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
                        @else
                            <img src="{{asset('assets/img/avatars/1.png')}}" alt="project-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
                        @endif

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
                        <input class="form-control" type="text" id="firstName" name="name" autofocus value="{{$project->name}}"/>
                    </div>

                </div>
                <div class="row g-6">
                    <div class="col-md">
                        <label for="basic-default-message" class="col-sm-2 col-form-label">{{__('project.description')}}</label>
                        <textarea id="basic-default-message"
                                  class="form-control"
                                  placeholder="{{__('project.description')}}"
                                  name="description" autofocus >{{$project->description}}</textarea>
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
                <h5 class="card-title mb-0">{{__('user.developer')}}:</h5>
            </div>
            <div class="d-flex  align-items-center col-md-auto flex-wrap align-content-end">
                <div class="align-self-end">
                    <button type="submit" class="btn btn-success me-3" data-bs-toggle="modal" data-bs-target="#basicModal"><i class="bx bx-plus"></i>{{__('project.add')}}</button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('projects.users.store', $project ) }}" method="POST">
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
                @foreach($project->users()->role('developer')->get() as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone}}</td>
                    <td>active</td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                            </div>
                        </div>
                    </td>

                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- end Developers -->

    <!-- Clients -->
    <div class="card">
        <div class="row card-header border-bottom mx-0 px-3">
            <div class="d-md-flex justify-content-between align-items-center col-md-auto me-auto">
                <h5 class="card-title mb-0">{{__('user.client')}}:</h5>
            </div>
            <div class="d-flex  align-items-center col-md-auto flex-wrap align-content-end">
                <div class="align-self-end">
                    <button type="submit" class="btn btn-success me-3" data-bs-toggle="modal" data-bs-target="#basicModalClients"><i class="bx bx-plus"></i>{{__('project.add')}}</button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="basicModalClients" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('projects.users.store', $project ) }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col mb-4">
                                            <label for="clientSelect" class="form-label">Small select</label>
                                            <select id="clientSelect" class="form-select form-select-sm" name="user_id">
                                                @foreach($clients as $user)
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
                                    <button type="submit" class="btn btn-primary">Add Client</button>
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
                @foreach($project->users()->role('client')->get() as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td>active</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                </div>
                            </div>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- end Clients -->




@endsection

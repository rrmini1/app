@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Account')

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

        <!-- Stages  -->
        <div class="card">
            <div class="row card-header border-bottom mx-0 px-3">
                <div class="d-md-flex justify-content-between align-items-center col-md-auto me-auto">
                    <h5 class="card-title mb-0">Этапы проекта:</h5>
                </div>
                <div class="d-flex  align-items-center col-md-auto flex-wrap align-content-end">
                    <div class="align-self-end">
                        <button type="submit" class="btn btn-success me-3" data-bs-toggle="modal" data-bs-target="#basicModal"><i class="bx bx-plus"></i>{{__('project.add')}}</button>
                    </div>
                    <!-- Modal -->
                    <x-stage-dialog :project="$project" id="basicModal"></x-stage-dialog>
                </div>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>{{__('№')}}</th>
                        <th>{{__('Название')}}</th>
                        <th>{{__('Начало')}}</th>
                        <th>{{__('Окончание')}}</th>
                        <th>{{__('Стоимость')}}</th>
                        <th>{{__('Статус Оплаты')}}</th>
                        <th>{{__('Статус выполнения')}}</th>
                        <th><i class='bx  bx-pencil  me-1'  ></i>  </th>

                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($project->stages()->get() as $index => $stage)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$stage->name}}</td>
                            <td>{{$stage->start}}</td>
                            <td>{{$stage->finish}}</td>
                            <td>{{$stage->price}}</td>
                            <td>@if($stage->pay_status){{__('оплачено')}}@else
                                    {{ __('не оплачено')}} @endif</td>
                            <td>{{__($stage->work_status)}}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a type="button" class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#basicModalEdit"><i class="bx bx-edit-alt me-1"></i>{{__('user.edit')}}</a>
                                        <a type="button" class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#basicModalEdit"><i class="bx bx-edit-alt me-1"></i>{{__('Выписать счет')}}</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>{{__('user.delete')}}</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <x-stage-dialog :project="$project" :stage="$stage" id="basicModalEdit"></x-stage-dialog>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end Stages -->
    </div>
@endsection

@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard')

@section('vendor-style')
    @vite('resources/assets/vendor/libs/apex-charts/apex-charts.scss')
@endsection

@section('vendor-script')
    @vite('resources/assets/vendor/libs/apex-charts/apexcharts.js')
@endsection

@section('page-script')
    @vite('resources/assets/js/dashboards-analytics.js')
@endsection

@section('content')
    <div class="card">
        <h5 class="card-header">{{ __('user.clients')}}</h5>
        <div class="table-responsive text-nowrap">
            <table class="table  table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>{{__('user.name')}}</th>
                    <th>{{__('user.email')}}</th>
                    <th>{{__('user.phone')}}</th>
                    <th>{{__('user.status')}}</th>
                    <th>{{__('user.actions')}}</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($users as $user)
                        <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }} {{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        @if($user->email_verified_at)
                            <td><span class="badge bg-label-success me-1">Active</span></td>
                        @else
                                <td><span class="badge bg-label-secondary me-1">Disable</span></td>
                        @endif

                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i>{{__('user.edit')}}</a>
                                    <a class="dropdown-item text-danger" href="javascript:void(0);"><i class="bx bx-trash me-1 "></i>{{__('user.delete')}}</a>
                                </div>
                            </div>
                        </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5"><h3>Записей не найдено</h3></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

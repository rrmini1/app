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
        <div class="card-datatable table-responsive ">
            <div class="card-header flex-column flex-md-row pb-0">
                <div class="head-label text-center">
                    <h5 class="card-title">{{ __('user.clients')}}</h5>
                </div>
                <div class="dt-action-buttons text-end mb-5">
                    <a class="btn btn-success add-new" href="{{route('users.create')}}">
                        <span>
                            <i class="bx bx-plus bx-sm me-0 me-sm-2"></i>
                            <span class="d-none d-sm-inline-block">{{__('user.add')}}</span>
                        </span>
                    </a>
                </div>
            </div>
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
                                        <a class="dropdown-item" href="{{ route('users.edit', ['user' => $user->id]) }}"><i class="bx bx-edit-alt me-1"></i>{{__('user.edit')}}</a>
                                        <a class="dropdown-item text-danger delete" href="javascript:void(0);" rel="{{ $user->id }}"><i class="bx bx-trash me-1 "></i>{{__('user.delete')}}</a>
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

        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function () {
                const items = document.querySelectorAll('.delete');
                items.forEach(function (item) {
                    item.addEventListener('click', function () {
                        const id = this.getAttribute('rel');
                        if (confirm("Вы уверены что хотите удалить пользователя с #ID = " + id)) {
                            fetch(`/users/${id}`, {
                                method: "DELETE",
                                headers: {
                                    "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").getAttribute('content')
                                }
                            }).then(response => {
                                location.reload();
                            });
                        } else {
                            alert('Удаление отменено');
                        }
                    });
                });
            });
        </script>
    @endsection

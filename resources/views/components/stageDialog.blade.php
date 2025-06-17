<div class="modal fade"  tabindex="" aria-hidden="true" {{ $attributes }}>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">{{__('Добавление этапа проекта '. $project->id)}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="card mb-6">
                <h5 class="card-header">StageID: {{$stage->id}}</h5>
                <div class="card-body">
                    <form action="" method="POST">
                        @csrf
                        @isset($stage)
                            @method("put")
                        @endisset
                        <div class="mb-4 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">{{__('Название')}}</label>
                            <div class="col-md-10">
                                <input
                                    class="form-control" type="text"
                                    @if($stage->name)  value="{{$stage->name}}" @else value="{{ __('Название этапа проекта') }}" @endif
                                    id="html5-text-input" />
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label for="exampleFormControlTextarea1" class="col-md-2 col-form-label">{{__('Описание')}}</label>
                            <div class="col-md-10">
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5">{{$stage->content}}</textarea>
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label for="html5-number-input" class="col-md-2 col-form-label">{{__('Стоимость')}}</label>
                            <div class="col-md-10">
                                <input class="form-control" type="number" value="{{$stage->price}}" id="html5-number-input" />
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label for="html5-date-input" class="col-md-2 col-form-label">{{__('Начало')}}</label>
                            <div class="col-md-10">
                                <input class="form-control" type="date" value="{{$stage->start}}" id="html5-date-input" />
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label for="html5-date-input" class="col-md-2 col-form-label">{{__('Окончание')}}</label>
                            <div class="col-md-10">
                                <input class="form-control" type="date" value="{{$stage->finish}}" id="html5-date-input" />
                            </div>
                        </div>
                        <div class="mb-4 row ">
                            <label class="col-md-2 col-form-label" for="defaultCheck3">
                                {{__('Оплачено')}}
                            </label>
                            <div class="col-md-10">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck3" @if($stage->pay_status) checked @endif />
                            </div>
                        </div>
                        <div class="mb-4 row ">
                            <label for="largeSelect" class="col-md-4 col-form-label">{{__('Статус выполнения')}}</label>
                            <div class="col-md-8">
                                <select id="largeSelect" class="form-select form-select-lg">
                                    <option value="on the go" {{ $stage->work_status == "on the go" ? 'selected' : ''}}>on the go</option>
                                    <option value="completed" {{ $stage->work_status == "completed" ? 'selected' : ''}}>completed</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">{{__('project.close')}}</button>
                            <button type="submit" class="btn btn-primary">{{__('project.addDevelop')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

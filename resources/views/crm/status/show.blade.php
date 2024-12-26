@extends('layouts.crm')

@section('content')
<div class="content-page">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12 mb-4 mt-1">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h4 class="font-weight-bold">Статус
                        <div class="badge badge-pill border border-dark text-dark">ID {{ $status->id }}</div>

                        <a href="{{ route('crm.status.index') }}">
                            <div class="badge badge-pill border border-dark text-dark">Назад</div>
                        </a>
                    </h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h5 class="card-title">Информация о статусе</h5>
                        </div>
                        <a href="{{ route('crm.status.edit', $status->id) }}" class="btn btn-outline-success sml-btn but-square p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </a>
                    </div>
                    <div class="card-body">

                        <div class="form-row mt-3">
                            <div class="col">
                                <label for="last_name">Название статуса</label>
                                <input type="text" class="form-control" name="name" value="{{ $status->name }}" placeholder="" disabled>
                            </div>
                        </div>

                        <div class="form-row mt-3">
                            <div class="col">
                                <label for="last_name">Название пункта меню</label>
                                <input type="text" class="form-control" name="menu_title"
                                       value="{{ $status->menu_title }}" placeholder="" disabled>
                            </div>
                        </div>

                        <div class="form-row mt-3">
                            <div class="col">
                                <label for="last_name">Название действия для кнопок</label>
                                <input type="text" class="form-control" name="action_title"
                                       value="{{ $status->action_title }}" placeholder="" disabled>
                            </div>
                        </div>

                        <div class="form-row mt-3 p-1">
                            <label for="color">Цвет</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">#</span>
                                </div>
                                <input type="text" name="color" value="{{ $status->color }}" class="form-control color-input" maxlength="6" disabled>
                            </div>
                        </div>

                        <div class="form-row mt-3 image-choose input-file">
                            <div class="col-sm-12 title">
                                <p>Иконка статуса</p>
                            </div>
                            <div class="col-sm-3 preview-block">
                                <div class="image_preview input-file-list">
                                    <img src="{{ asset($status->icon) }}" alt="" class="svg">
                                </div>
                            </div>
                        </div>

                        <div class="form-row mt-3">
                            <div class="col">
                                <label for="last_name">Порядок в меню</label>
                                <input type="text" class="form-control" name="order" value="{{ $status->order }}"
                                       placeholder="" maxlength="2" disabled>
                            </div>
                        </div>


                    </div>
                </div>

                @include('includes.logs')

            </div>
        </div>


    </div>
</div>
@endsection

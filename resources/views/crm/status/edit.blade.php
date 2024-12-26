@extends('layouts.crm')

@section('content')
<div class="content-page">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12 mb-4 mt-1">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h4 class="font-weight-bold">Редактирование статуса
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
                        <a href="{{ route('crm.status.show', $status->id) }}" class="btn btn-outline-primary sml-btn but-square p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </a>
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{route('crm.status.update', $status->id)}}"  enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            @if ($errors->any())
                                @include('includes.errors')
                            @endif

                            <div class="form-row mt-3">
                                <div class="col">
                                    <label for="last_name">Название</label>
                                    <input type="text" class="form-control" name="name"
                                           value="{{ old('name', $status->name) }}" placeholder="" required>
                                </div>
                            </div>

                            <div class="form-row mt-3">
                                <div class="col">
                                    <label for="last_name">Название пункта меню</label>
                                    <input type="text" class="form-control" name="menu_title"
                                           value="{{ old('menu_title', $status->menu_title) }}" placeholder="" required>
                                </div>
                            </div>

                            <div class="form-row mt-3">
                                <div class="col">
                                    <label for="last_name">Название действия для кнопок</label>
                                    <input type="text" class="form-control" name="action_title"
                                           value="{{ old('action_title', $status->action_title) }}" placeholder="" required>
                                </div>
                            </div>

                            <div class="form-row mt-3 p-1">
                                <label for="color">Цвет</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">#</span>
                                    </div>
                                    <input type="text" name="color" value="{{ old('color', $status->color) }}" class="form-control color-input" maxlength="6" required>
                                </div>
                            </div>

                            <div class="form-row mt-3 icon-choose">
                                <div class="col-sm-12 title">
                                    <p>Иконка статуса</p>
                                </div>
                                <div class="col-sm-6 icon-block d-flex align-items-center">
                                    <div class="custom-icon mb-3">
                                        <input type="hidden" name="icon" value="{{ old('icon', $status->icon) }}">
                                        <a href="#" class="btn btn-secondary text-white choose-icon">Выбрать иконку</a>
                                    </div>
                                </div>
                                <div class="col-sm-6 preview-block">
                                    <div class="image_preview input-file-list">
                                        <img src="{{ asset($status->icon) }}" alt="" class="svg">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row mt-3">
                                <div class="col">
                                    <label for="last_name">Порядок в меню</label>
                                    <input type="text" class="form-control" name="order" value="{{ old('order', $status->order) }}"
                                           placeholder="" maxlength="2" required>
                                </div>
                            </div>


                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>

                        </form>

                    </div>
                </div>

                @include('includes.logs')

            </div>
        </div>


    </div>
</div>
@endsection

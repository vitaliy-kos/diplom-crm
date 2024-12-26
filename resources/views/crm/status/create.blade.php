@extends('layouts.crm')

@section('content')
    <div class="content-page">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12 mb-4 mt-1">
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <h4 class="font-weight-bold">Создание статуса
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
                        </div>
                        <div class="card-body">

                            <form method="POST" action="{{route('crm.status.store')}}" enctype="multipart/form-data">
                                @csrf

                                @if ($errors->any())
                                    @include('includes.errors')
                                @endif

                                <div class="form-row mt-3">
                                    <div class="col">
                                        <label for="last_name">Название статуса</label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                               placeholder="" required>
                                    </div>
                                </div>

                                <div class="form-row mt-3">
                                    <div class="col">
                                        <label for="last_name">Название пункта меню</label>
                                        <input type="text" class="form-control" name="menu_title"
                                               value="{{ old('menu_title') }}" placeholder="" required>
                                    </div>
                                </div>

                                <div class="form-row mt-3">
                                    <div class="col">
                                        <label for="last_name">Название действия для кнопок</label>
                                        <input type="text" class="form-control" name="action_title"
                                               value="{{ old('action_title') }}" placeholder="" required>
                                    </div>
                                </div>

                                <div class="form-row mt-3 p-1">
                                    <label for="color">Цвет</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">#</span>
                                        </div>
                                        <input type="text" name="color" value="{{ old('color') }}" class="form-control color-input" maxlength="6" required>
                                    </div>
                                </div>

                                <div class="form-row mt-3 icon-choose">
                                    <div class="col-sm-12 title">
                                        <p>Иконка статуса</p>
                                    </div>
                                    <div class="col-sm-6 icon-block d-flex align-items-center">
                                        <div class="custom-icon mb-3">
                                            <input type="hidden" name="icon" value="{{ old('icon') }}">
                                            <a href="#" class="btn btn-secondary text-white choose-icon">Выбрать иконку</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 preview-block">
                                        <div class="image_preview input-file-list">
                                            <img src="{{ asset('/assets/images/blank.jpg') }}" alt="" class="svg">
                                        </div>
                                    </div>
                                </div>

{{--                                <div class="form-row mt-3 image-choose input-file">--}}
{{--                                    <div class="col-sm-12 title">--}}
{{--                                        <p>Иконка статуса</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-sm-6 file-block">--}}
{{--                                        <div class="custom-file mb-3">--}}
{{--                                            <input type="file" class="custom-file-input" id="customFile" name="icon">--}}
{{--                                            <label class="custom-file-label" for="customFile">Изображение</label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-sm-6 preview-block">--}}
{{--                                        <div class="image_preview input-file-list">--}}
{{--                                            <img src="{{ asset('/assets/images/blank.jpg') }}" alt="">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="form-row mt-3">
                                    <div class="col">
                                        <label for="last_name">Порядок в меню</label>
                                        <input type="text" class="form-control" name="order" value="{{ old('order') }}"
                                               placeholder="" maxlength="2" required>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Создать</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection

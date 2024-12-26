@extends('layouts.crm')

@section('content')
    <div class="content-page">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12 mb-4 mt-1">
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <h4 class="font-weight-bold">Создание бренда
                            <a href="{{ route('crm.brand.index') }}">
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
                                <h5 class="card-title">Информация о бренде</h5>
                            </div>
                        </div>
                        <div class="card-body">

                            <form method="POST" action="{{route('crm.brand.store')}}" enctype="multipart/form-data">
                                @csrf

                                @if ($errors->any())
                                    @include('includes.errors')
                                @endif

                                <div class="form-row mt-3">
                                    <div class="col">
                                        <label for="last_name">Название</label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="" required>
                                    </div>
                                </div>

                                <div class="form-row mt-3 picture-choose">
                                    <p>Логотип</p>
                                    <div class="custom-file mb-3">
                                        <input type="file" class="custom-file-input" id="pictureCustomFile" name="logo" accept="image/*" required>
                                        <label class="custom-file-label" for="customFile">Выбрать логотип</label>
                                    </div>
                                    <div class="col-sm-12 preview-block d-flex justify-content-center">
                                        <div class="image_preview input-file-list">
                                            <img src="{{ asset('/assets/images/blank.jpg') }}" alt="" class="svg">
                                        </div>
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

@extends('layouts.crm')

@section('content')
<div class="content-page">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12 mb-4 mt-1">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h4 class="font-weight-bold">Редактирование бренда
                        <div class="badge badge-pill border border-dark text-dark">ID {{ $brand->id }}</div>

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
                        <a href="{{ route('crm.brand.show', $brand->id) }}" class="btn btn-outline-primary sml-btn but-square p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </a>
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{route('crm.brand.update', $brand->id)}}"  enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            @if ($errors->any())
                                @include('includes.errors')
                            @endif

                            <div class="form-row mt-3">
                                <div class="col">
                                    <label for="last_name">Название</label>
                                    <input type="text" class="form-control" name="name"
                                           value="{{ old('name', $brand->name) }}" placeholder="" required>
                                </div>
                            </div>

                            <div class="form-row mt-3 picture-choose">
                                <p>Логотип</p>
                                <div class="custom-file mb-3">
                                    <input type="file" class="custom-file-input" id="pictureCustomFile" name="logo" accept="image/*">
                                    <label class="custom-file-label" for="customFile">Выбрать логотип</label>
                                </div>
                                <div class="col-sm-12 preview-block d-flex justify-content-center">
                                    <div class="image_preview input-file-list">
                                        <img src="{{ asset($brand->logo) }}" alt="" class="svg">
                                    </div>
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
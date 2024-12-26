@extends('layouts.crm')

@section('content')
<div class="content-page">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12 mb-4 mt-1">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h4 class="font-weight-bold">Создание города
                        <a href="{{ route('crm.city.index') }}">
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
                            <h5 class="card-title">Информация о городе</h5>
                        </div>
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{route('crm.city.store')}}">
                            @csrf

                            @if ($errors->any())
                                @include('includes.errors')
                            @endif

                            <div class="form-row mt-3">
                                <div class="col">
                                    <label for="last_name">Название на русском</label>
                                    <input type="text" class="form-control" name="name_ru" value="{{ old('name_ru') }}" placeholder="" required>
                                </div>
                            </div>

                            <div class="form-row mt-3">
                                <div class="col">
                                    <label for="last_name">Название на английском</label>
                                    <input type="text" class="form-control" name="name_en" value="{{ old('name_en') }}" placeholder="" required>
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

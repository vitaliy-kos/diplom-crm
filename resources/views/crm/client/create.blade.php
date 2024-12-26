@extends('layouts.crm')

@section('content')
    <div class="content-page">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12 mb-4 mt-1">
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <h4 class="font-weight-bold">Создание клиента
                            <a href="{{ route('crm.client.index') }}">
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
                                <h5 class="card-title">Информация о клиенте</h5>
                            </div>
                        </div>
                        <div class="card-body">

                            <form method="POST" action="{{route('crm.client.store')}}">
                                @csrf

                                @if ($errors->any())
                                    @include('includes.errors')
                                @endif

                                <div class="form-row mt-3">
                                    <div class="col">
                                        <label for="last_name">Фамилия</label>
                                        <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
                                    </div>
                                    <div class="col">
                                        <label for="first_name">Имя</label>
                                        <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">
                                    </div>
                                </div>

                                <div class="form-row mt-3">
                                    <div class="col">
                                        <label for="middle_name">Отчество</label>
                                        <input type="text" class="form-control" name="middle_name" value="{{ old('middle_name') }}">
                                    </div>
                                    <div class="col">
                                        <label for="city">Город</label>
                                        <select name="city_id" class="form-control choicesjs">
                                            <option placeholder>Выберите город</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}" {{ $city->id === (int) old('city_id') ? 'selected' : '' }}>{{ $city->name_ru }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-row mt-3">
                                    <div class="col">
                                    <label for="phone">Телефон</label>
                                    <input type="tel" class="form-control" name="phone" value="{{ old('phone') }}">
                                    </div>
                                    <div class="col">
                                    <label for="additional_phone">Дополнительный телефон</label>
                                    <input type="tel" class="form-control" name="additional_phone" value="{{ old('additional_phone') }}">
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="form-group">
                                    <label for="comment">Комментарий</label>
                                    <textarea class="form-control" name="comment" rows="3">{{ old('comment') }}</textarea>
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

@extends('layouts.crm')

@section('content')
<div class="content-page">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12 mb-4 mt-1">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h4 class="font-weight-bold">Добавление телефона
                        <a href="{{ route('crm.phone.index') }}">
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
                            <h5 class="card-title">Информация о телефоне</h5>
                        </div>
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{route('crm.phone.store')}}">
                            @csrf

                            @if ($errors->any())
                                @include('includes.errors')
                            @endif

                            <div class="form-row mt-3">
                                <div class="col">
                                    <label for="number">Телефон</label>
                                    <input type="tel" class="form-control" name="number" value="{{ old('number') }}">
                                </div>
                            </div>

                            <div class="form-row mt-3">
                                <div class="col">
                                    <label for="city">Сайт</label>
                                    <select name="site_id" class="form-control choicesjs">
                                        <option placeholder>Выберите сайт</option>
                                        @foreach ($sites as $site)
                                            <option value="{{ $site->id }}" {{ $site->id === (int) old('site_id') ? 'selected' : '' }}>{{ "{$site->name} - {$site->url}" }}</option>
                                        @endforeach
                                    </select>
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

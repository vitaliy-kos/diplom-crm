@extends('layouts.crm')

@section('content')
<div class="content-page">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12 mb-4 mt-1">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h4 class="font-weight-bold">Создание вида поломок
                        <a href="{{ route('crm.brokenType.index') }}">
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
                            <h5 class="card-title">Информация о поломке</h5>
                        </div>
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{route('crm.brokenType.store')}}">
                            @csrf

                            @if ($errors->any())
                                @include('includes.errors')
                            @endif

                            <div class="form-row mt-3">
                                <div class="col">
                                    <label for="city">Тип техники</label>
                                    <select name="technic_type_id" class="form-control choicesjs" required>
                                        <option placeholder>Выберите тип техники</option>
                                        @foreach ($technics_types as $technics_type)
                                            <option value="{{ $technics_type->id }}" {{ $technics_type->id === (int) old('technic_type_id') ? 'selected' : '' }}>{{ $technics_type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-row mt-3">
                                <div class="col">
                                    <label for="last_name">Название поломки</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="" required>
                                </div>
                            </div>

                            <div class="mt-3">
                                <div class="form-group">
                                <label for="description">Описание</label>
                                <textarea class="form-control" name="description" rows="3" required>{{ old('description') }}</textarea>
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

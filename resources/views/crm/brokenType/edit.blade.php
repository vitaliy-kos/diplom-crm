@extends('layouts.crm')

@section('content')
<div class="content-page">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12 mb-4 mt-1">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h4 class="font-weight-bold">Редактирование вида поломки
                        <div class="badge badge-pill border border-dark text-dark">ID {{ $brokenType->id }}</div>

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
                            <h5 class="card-title">Информация о типе техники</h5>
                        </div>
                        <a href="{{ route('crm.brokenType.show', $brokenType->id) }}" class="btn btn-outline-primary sml-btn but-square p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </a>
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{route('crm.brokenType.update', $brokenType->id)}}">
                            @csrf
                            @method('PATCH')

                            @if ($errors->any())
                                @include('includes.errors')
                            @endif

                            <div class="form-row mt-3">
                                <div class="col">
                                    <label for="city">Тип техники</label>
                                    <select name="technic_type_id" class="form-control choicesjs" required>
                                        <option placeholder>Выберите тип техники</option>
                                        @foreach ($technics_types as $technics_type)
                                            <option value="{{ $technics_type->id }}" {{ $technics_type->id === (int) old('name', $brokenType->technic_type_id) ? 'selected' : '' }}>{{ $technics_type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-row mt-3">
                                <div class="col">
                                    <label for="last_name">Название</label>
                                    <input type="text" class="form-control" name="name"
                                           value="{{ old('name', $brokenType->name) }}" placeholder="" required>
                                </div>
                            </div>

                            <div class="mt-3">
                                <div class="form-group">
                                <label for="description">Описание</label>
                                <textarea class="form-control" name="description" rows="3" required>{{ old('description', $brokenType->description) }}</textarea>
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

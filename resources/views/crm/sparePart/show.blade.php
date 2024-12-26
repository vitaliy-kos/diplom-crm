@extends('layouts.crm')

@section('content')
<div class="content-page">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12 mb-4 mt-1">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h4 class="font-weight-bold">Запчасть
                        <div class="badge badge-pill border border-dark text-dark">ID {{ $sparePart->id }}</div>

                        <a href="{{ route('crm.sparePart.index') }}">
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
                        <a href="{{ route('crm.sparePart.edit', $sparePart->id) }}" class="btn btn-outline-success sml-btn but-square p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </a>
                    </div>
                    <div class="card-body">

                        <div class="form-row mt-3">
                            <div class="col">
                                <label for="city">Тип техники</label>
                                <select name="technic_type_id" class="form-control choicesjs" disabled>
                                    <option placeholder>Выберите тип техники</option>
                                    @foreach ($technics_types as $technics_type)
                                        <option value="{{ $technics_type->id }}" {{ $technics_type->id === (int) $sparePart->technic_type_id ? 'selected' : '' }}>{{ $technics_type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-row mt-3">
                            <div class="col">
                                <label for="last_name">Название</label>
                                <input type="text" class="form-control" name="name" value="{{ $sparePart->name }}" placeholder="" disabled>
                            </div>
                        </div>

                        <div class="mt-3">
                            <div class="form-group">
                            <label for="description">Комментарий</label>
                            <textarea class="form-control" name="description" rows="3" disabled>{{ $sparePart->description }}</textarea>
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

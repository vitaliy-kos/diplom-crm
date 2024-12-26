@extends('layouts.crm')

@section('content')
<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mb-4 mt-1">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h4 class="font-weight-bold">Типы техники</h4>
                    <a href="{{ route('crm.technicsType.create') }}" class="btn btn-outline-primary mt-2">Добавить тип техники</a>
                </div>
            </div>
        </div>

        <table id="datatable" class="table data-table table-striped table-bordered clients-table table-mobile">
            <thead>
            <tr>
                <th style="width:10%">ID</th>
                <th style="width:30%">Название</th>
                <th style="width:40%">Описание</th>
                <th style="width:20%" class="text-center">Действия</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($technicsTypes as $technicsType)
                    <tr>
                        <td data-label="ID">{{ $technicsType->id }}</td>
                        <td data-label="Название">{{ $technicsType->name }}</td>
                        <td data-label="Описание">{{ $technicsType->description }}</td>
                        <td data-label="Действия" class="center">

                            <a href="{{ route('crm.technicsType.show', $technicsType->id) }}" class="btn btn-outline-primary sml-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </a>

                            <a href="{{ route('crm.technicsType.edit', $technicsType->id) }}" class="btn btn-outline-success sml-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection
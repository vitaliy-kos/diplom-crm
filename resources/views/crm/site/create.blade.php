@extends('layouts.crm')

@section('content')
<div class="content-page">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12 mb-4 mt-1">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h4 class="font-weight-bold">Добавление сайта
                        <a href="{{ route('crm.site.index') }}">
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
                            <h5 class="card-title">Информация о сайте</h5>
                        </div>
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{route('crm.site.store')}}">
                            @csrf

                            @if ($errors->any())
                                @include('includes.errors')
                            @endif

                            <div class="form-row mt-3">
                                <div class="col">
                                    <label for="name">Название</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="" required>
                                </div>
                            </div>

                            <div class="form-row mt-3">
                                <div class="col">
                                    <label for="url">URL</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">https://</span>
                                        </div>
                                        <input 
                                            type="text" 
                                            class="form-control" 
                                            name="url"
                                            value="{{ old('url') }}"
                                            required>
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

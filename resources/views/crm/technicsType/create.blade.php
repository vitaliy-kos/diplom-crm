@extends('layouts.crm')

@section('content')
<div class="content-page">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12 mb-4 mt-1">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h4 class="font-weight-bold">Создание типа техники
                        <a href="{{ route('crm.technicsType.index') }}">
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
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{route('crm.technicsType.store')}}">
                            @csrf

                            @if ($errors->any())
                                @include('includes.errors')
                            @endif

                            <div class="form-row mt-3">
                                <div class="col">
                                    <label for="last_name">Название техники</label>
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

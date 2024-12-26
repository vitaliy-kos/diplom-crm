@extends('layouts.crm')

@section('content')
<div class="content-page">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12 mb-4 mt-1">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h4 class="font-weight-bold">Создание пользователя
                        <a href="{{ route('crm.user.index') }}">
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
                            <h5 class="card-title">Информация о пользователе</h5>
                        </div>
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{route('crm.user.store')}}">
                            @csrf

                            @if ($errors->any())
                                @include('includes.errors')
                            @endif

                            <div class="form-row">
                                <div class="col">
                                    <label for="city">Права</label>
                                    <select name="role" class="form-control choicesjs">
                                        <option placeholder>Не выбраны</option>
                                        @foreach($roles as $id => $role)
                                            <option value="{{ $id }}" {{ $id === old('role') ? 'selected' : '' }}>{{ $role }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-row mt-3">
                                <div class="col">
                                    <label for="last_name">Имя</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="" required>
                                </div>
                            </div>

                            <div class="form-row mt-3">
                                <div class="col">
                                    <label for="last_name">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="" required>
                                </div>
                            </div>

                            <div class="form-row mt-3">
                                <div class="col">
                                    <label for="last_name">Пароль</label>
                                    <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="" required>
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

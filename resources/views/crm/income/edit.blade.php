@extends('layouts.crm')

@section('content')
<div class="content-page">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12 mb-4 mt-1">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h4 class="font-weight-bold">Редактирование прихода
                        <div class="badge badge-pill border border-dark text-dark">ID {{ $income->id }}</div>

                        <a href="{{ route('crm.income.index') }}">
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
                            <h5 class="card-title">Информация о приходе</h5>
                        </div>
                        <a href="{{ route('crm.income.show', $income->id) }}" class="btn btn-outline-primary sml-btn but-square p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </a>
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{route('crm.income.update', $income->id)}}">
                            @csrf
                            @method('PATCH')

                            @if ($errors->any())
                                @include('includes.errors')
                            @endif

                            <div class="form-row mt-3">
                                <div class="col">
                                    <label>Тип прихода</label>
                                    <select name="type_id" class="form-control choicesjs">
                                        <option placeholder>Не выбран</option>
                                        @foreach($income_types as $type)
                                            <option
                                                value="{{ $type->id }}" {{ $type->id === (int) old('type_id', $income->type_id) ? 'selected' : '' }}>{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-3">

                                <div class="col-sm-6 mt-2">
                                    <label>Сумма прихода</label>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₽</span>
                                        </div>
                                        <input type="text" name="sum"
                                               class="form-control form-control-lg numeric" aria-label="Сумма"
                                               maxlength="7"
                                               value="{{ old('sum', $income->sum) }}" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 mt-3">
                                    <label for="first_name">Дата прихода</label>
                                    <div class="date-icon-set">
                                        <input type="text" name="date" id="createExpenseDate"
                                               class="form-control" placeholder="Выберите дату прихода"
                                               value="{{ old('date', $income->date) }}" required>
                                        <span class="search-link">
                                                 <svg xmlns="http://www.w3.org/2000/svg" class="" width="20" fill="none"
                                                      viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                 </svg>
                                            </span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-1">
                                <div class="form-group text-center">
                                    <label for="comment">Комментарий</label>
                                    <textarea class="form-control" name="comment"
                                              rows="2">{{ old('comment', $income->comment) }}</textarea>
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

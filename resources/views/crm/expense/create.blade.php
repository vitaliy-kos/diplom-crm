@extends('layouts.crm')

@section('content')
    <div class="content-page">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12 mb-4 mt-1">
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <h4 class="font-weight-bold">Создание расхода
                            <a href="{{ route('crm.expense.index') }}">
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
                                <h5 class="card-title">Информация о расходе</h5>
                            </div>
                        </div>
                        <div class="card-body">

                            <form method="POST" action="{{route('crm.expense.store')}}">
                                @csrf

                                @if ($errors->any())
                                    @include('includes.errors')
                                @endif

                                <div class="form-row mt-3">
                                    <div class="col">
                                        <label>Тип расхода</label>
                                        <select name="type_id" class="form-control choicesjs">
                                            <option placeholder>Не выбран</option>
                                            @foreach($expense_types as $type)
                                                <option
                                                    value="{{ $type->id }}" {{ $type->id === (int) old('type_id') ? 'selected' : '' }}>{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mt-3">

                                    <div class="col-sm-6 mt-2">
                                        <label>Сумма расхода</label>
                                        <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₽</span>
                                            </div>
                                            <input type="text" name="sum"
                                                   class="form-control form-control-lg numeric" aria-label="Сумма"
                                                   maxlength="7"
                                                   value="{{ old('sum') }}" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 mt-3">
                                        <label for="first_name">Дата прихода</label>
                                        <div class="date-icon-set">
                                            <input type="text" name="date" id="createExpenseDate"
                                                   class="form-control" placeholder="Выберите дату расхода"
                                                   value="{{ old('date') }}" required>
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
                                                  rows="2">{{ old('comment') }}</textarea>
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

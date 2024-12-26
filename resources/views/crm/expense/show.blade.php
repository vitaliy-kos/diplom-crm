@extends('layouts.crm')

@section('content')
<div class="content-page">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12 mb-4 mt-1">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h4 class="font-weight-bold">Расход
                        <div class="badge badge-pill border border-dark text-dark">ID {{ $expense->id }}</div>

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
                            <h5 class="card-title">Информация о приходе</h5>
                        </div>
                        <a href="{{ route('crm.expense.edit', $expense->id) }}" class="btn btn-outline-success sml-btn but-square p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </a>
                    </div>

                    <div class="card-body">

                        <form>
                            <div class="form-row mt-3">
                                <div class="col">
                                    <label>Тип прихода</label>
                                    <select name="type_id" class="form-control choicesjs" disabled>
                                        <option placeholder>Не выбран</option>
                                        @foreach($expense_types as $type)
                                            <option
                                                value="{{ $type->id }}" {{ $type->id === $expense->type_id ? 'selected' : '' }}>{{ $type->name }}</option>
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
                                               value="{{ $expense->sum }}" disabled>
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
                                               value="{{ $expense->date }}" disabled>
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
                                    <textarea class="form-control"
                                              rows="2" disabled>{{ $expense->comment }}</textarea>
                                </div>
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

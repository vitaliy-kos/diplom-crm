@extends('layouts.crm')

@section('content')
    <div class="content-page">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12 mb-4 mt-1">
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <h4 class="font-weight-bold">Создание заказа
                            <a href="{{ route('crm.order.index') }}">
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
                                <h5 class="card-title">Информация о заказе</h5>
                            </div>
                        </div>
                        <div class="card-body">

                            <form method="POST" action="{{route('crm.order.store')}}">
                                @csrf

                                @if ($errors->any())
                                    @include('includes.errors')
                                @endif

                                <div class="form-row mt-3">

                                    <div class="col-12">
                                        <label for="first_name">Выберите клиента</label>
                                        <select name="client_id" class="form-control choicesjs">
                                            <option value="0" placeholder>Не выбран</option>
                                            @foreach ($clients as $client)
                                                <option value="{{ $client->id }}" {{ $client->id === (int) old('client_id') ? 'selected' : '' }}>
                                                    @if ($client->last_name || $client->first_name || $client->middle_name ) 
                                                        {{ "{$client->last_name} {$client->first_name} {$client->middle_name} - " }}
                                                    @endif
                                                    {{ $client->phone }} 
                                                    @if ($client->additional_phone) 
                                                        - {{ $client->additional_phone }}
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group mt-2 w-50">

                                    <label for="first_name">Выберите дату создания заказа</label>

                                    <div class="date-icon-set">

                                        <input 
                                            type="text" 
                                            name="date_creation" 
                                            id="createOrderDate" 
                                            class="form-control" 
                                            placeholder="Дата заказа" 
                                            value="{{ old('date_creation') }}" 
                                            inputmode="none">
                                    </div>

                                </div>

                                <div class="mt-3">
                                    <div class="form-group">
                                    <label for="comment">Комментарий</label>
                                    <textarea class="form-control" name="comment" rows="3">{{ old('comment') }}</textarea>
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

@extends('layouts.crm')

@section('content')
<div class="content-page">
    <div class="container-fluid">
        <input type="hidden" name="token" value="Bearer scGz0URiSG99ds-nRCJPxWw46TJTBquXF58Qub8DL5V3b2gU5siU!qOUGcZSF0iPILyRjajOym">

        <div class="row">
            <div class="col-md-12 mb-4 mt-1">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h4 class="font-weight-bold">Обращение с номера {{ convertPhoneToFormated($clientRequest->from_number) }} <div class="badge badge-pill border border-info text-info">ID обращения {{ $clientRequest->id }}</div></h4>
                    <h6 class="mt-2">Поступило {{ dateFormatted($clientRequest->date_start) }}</h6>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h5 class="card-title">Информация об обращении</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="#">
                            <div class="form-row mt-3">
                                <div class="col">
                                <label for="first_name">Тип обращения</label>
                                <input type="text" class="form-control" name="first_name" value="{{ requstType($clientRequest->type) }}" disabled>
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col">
                                <label for="middle_name">Дата обращения</label>
                                <input type="text" class="form-control" name="middle_name" value="{{ dateFormatted($clientRequest->date_start) }}" disabled>
                                </div>
                                @if ($clientRequest->type == 'call')
                                    <div class="col">
                                        <label for="city">Дата завершения звонка</label>
                                        <input type="text" class="form-control" name="city" value="@if ($clientRequest->date_finish){{ dateFormatted($clientRequest->date_finish) }}@endif"
                                        disabled>
                                    </div>
                                @endif
                            </div>

                            @if ($clientRequest->type == 'call')
                                <div class="form-row mt-3">
                                    <div class="col">
                                        <label for="phone">Продолжительность</label>
                                        <input type="text" class="form-control" name="phone" value="{{ convertSecondsToMinutes($clientRequest->duration_call) }}" disabled>
                                    </div>
                                    
                                    @if ($clientRequest->type == 'call' && !empty($clientRequest->unique_key) && $clientRequest->duration > 0 )
                                        <div class="col" style="margin:auto; text-align: center;" >
                                            <label for="additional_phone">Запись разговора</label>
                                            <br>
                                            <div class="audio" data-unique="<?php echo $clientRequest->unique_key ?>">
                                                <div class="loader-audio"></div>
                                            </div>
                                        </div>
                                    @endif
                                
                                </div>
                            @endif
                            
                            @if ($clientRequest->type == 'text')
                                <div class="mt-3">
                                    <div class="form-group">
                                        <label for="address">Страница сайта</label>
                                        <input type="text" class="form-control" name="address" value="{{ $clientRequest->site_page }}" disabled>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="form-group">
                                        <label for="comment">Текст сообщения</label>
                                        <textarea class="form-control" name="comment" rows="3" disabled><?php echo $clientRequest->message ?></textarea>
                                    </div>
                                </div>
                            @endif

                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h5 class="card-title">Заказ</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="requests_in_client list-group">
                            
                            @if ($clientRequest->order) 

                                <li class="list-group-item list-group-item-action">

                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">Заказ №{{ $clientRequest->order_id }} - {{ $clientRequest->order->status()->name }}</h5>
                                        <small class="text-muted"><?php //echo $order->sum_pay > 0 ? $Core->convertMoneyToPeople($order->sum_pay) : ''; ?></small>
                                    </div>
                                    <p class="mb-1">{{ dateFormatted($clientRequest->order->date_creation) }}</p>
                                    <p class="mb-1">
                                        <b>
                                            <?php
                                            // echo 'Услуга: ';
                                            // if ($order->usluga > 0) {
                                            // $usluga = $services_list[$order->usluga]->name;
                                            // }
                                            // if (isset($usluga)) {
                                            // echo $usluga;
                                            // } else {
                                            // echo 'не указана';
                                            // }
                                            ?>
                                        </b>
                                    </p>
                                    <small class="text-muted">
                                        <a href="{{ route('crm.order.edit', $clientRequest->order_id) }}">Перейти к заказу</a>
                                    </small>
                                </li>
                            @else
                                <p>Заказ не найден.</p>
                            @endif
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-md-4">

                <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h5 class="card-title">Информация о клиенте</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="last_name">Фамилия</label>
                        <input type="text" class="form-control" name="last_name" value="{{ $clientRequest->client->last_name }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="first_name">Имя</label>
                        <input type="text" class="form-control" name="first_name" value="{{ $clientRequest->client->first_name }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="middle_name">Отчество</label>
                        <input type="text" class="form-control" name="middle_name" value="{{ $clientRequest->client->middle_name }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="city">Город</label>
                        <input type="text" class="form-control" name="city" value="{{ $clientRequest->client?->city?->name_ru }}"
                        disabled>
                    </div>
                    <div class="form-group">
                        <label for="phone">Телефон</label>
                        <input type="tel" class="form-control" name="phone" value="{{ $clientRequest->client->phone }}"
                            disabled >
                    </div>
                    <div class="form-group">
                        <label for="additional_phone">Дополнительный телефон</label>
                        <input type="tel" class="form-control" name="additional_phone" value="{{ $clientRequest->client->additional_phone }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="address">Адрес</label>
                        <input type="text" class="form-control" name="address" value="{{ $clientRequest->client->address }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="comment">Комментарий</label>
                        <textarea class="form-control" name="comment" rows="3" disabled>{{ $clientRequest->client->comment }}</textarea>
                    </div>
                </div>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection

@extends('layouts.crm')

@section('content')
<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mb-4 mt-1">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h4 class="font-weight-bold">Заказы 
                        @if ($status)
                            {{ ": {$status->menu_name}" }}
                        @endif
                    </h4>
                </div>
            </div>
        </div>

        <form method="GET" action="{{ route('crm.order.index') }}" class="orders_filter"> 
            <div class="row table_filter mb-2">
                <!-- <input type="hidden" name="filter" value=""> -->
                
                <div class="col-sm-12 col-md-4 d-flex mb-1">
                    <label class="mr-1 mt-1">Сайт: </label>
                    <select name="site" class="site_select form-control form-control-sm autosubmit">
                        <option value="-1" >Не выбран</option>
                        @foreach ($sites as $site)
                            <option 
                                value="{{ $site->id }}" 
                                @if($request->get('site') == $site->id) selected 
                                @endif
                            >{{ $site->name }} - {{ $site->url }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- <div class="col-sm-12 col-md-4 d-flex mb-1">
                <label class="mr-1 mt-1">Город: </label>
                <select name="cities" class="cities_select form-control form-control-sm">
                    <option value="-1" >Фильтр не выбран</option>
                    <option value="0">Город не указан</option>
                    <?php 
                    //foreach ($cities_list as $id_cit => $value_cit) {
                    ?>
                        <option value=""></option>
                    <?php 
                    //}
                    ?>
                </select>
                </div> -->
            
                <!-- <div class="col-sm-12 col-md-4 d-flex mb-1">
                <label class="mr-1 mt-1">Услуга: </label>
                <select name="services" class="services_select form-control form-control-sm">
                    <option value="-1">Фильтр не выбран</option>
                    <option value="0">Услуга не указана</option>
                    <?php 
                    // foreach ($services_list as $is_serv => $value_serv) {
                    ?>
                        <option value=""></option>
                    <?php 
                    // }
                    ?>
                </select>
                </div> -->

                <div class="col-sm-12 col-md-4 d-flex mb-1">
                <label class="mr-1 mt-1">Поиск: </label>
                <input type="search" name="que" value="{{ $request->get('que') }}" class="form-control form-control-sm" placeholder="Поиск...">
                </div>

            </div>
        </form>
        
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-striped table-bordered clients-table table-mobile">
                    <thead>
                        <tr>
                            <th style="width:5%" class="text-center">ID</th>
                            <th style="width:36%">Клиент</th>
                            <th style="width:14%">Сумма заказа</th>
                            <th style="width:15%" class="text-center">Статус</th>
                            <th style="width:20%" class="text-center">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($orders))
                            @foreach ($orders as $order)
                                <tr @if($order->client->spam == 1) class="spam" @endif>
                                    <td data-label="ID клиента">{{ $order->id }}</td>
                                    <td data-label="ФИО" class="link data-mobile">
                                        <a href="{{ route('crm.order.edit', $order->id) }}">
                                            @if ( $order->client->first_name || $order->client->middle_name || $order->client->last_name )
                                                {{ "{$order->client->first_name} {$order->client->middle_name} {$order->client->last_name}" }}
                                            @else
                                                {{ 'Имя не известно' }}
                                            @endif
                                        </a>
                                        <br>
                                        {{ convertPhoneToFormated($order->client->phone) }}
                                        <br>
                                        <small>Создан: {{ dateFormatted($order->date_creation) }}</small>

                                    </td>
                                    <td data-label="Сумма заказа">
                                        {{ convertToMoney(countSumOfServices($order->services)) }}
                                    </td>
                                    <td data-label="Статус"><div class="badge border 
                                    
                                        @switch ($order->status()->id)
                                            @case (1)
                                                border-warning text-warning
                                                @break
                                            @case (2)
                                                border-info text-info
                                                @break
                                            @case (3)
                                                border-primary text-primary
                                                @break
                                            @case (4)
                                                border-success text-success
                                                @break
                                            @case (5)
                                                border-danger text-danger
                                                @break
                                        @endswitch
                                        ">
                                        {!! $order->status()->name !!}
                                        </div>
                                    </td>
                                    <td data-label="Действия">
                                        <div>
                                            <a href="{{ route('crm.order.edit', $order->id) }}" class="btn btn-outline-success mt-2 sml-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="odd">
                                <td valign="top" colspan="6" class="dataTables_empty" style="text-align: center;">Записей не найдено</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div> 
            
            <div class="">
                {{ $orders->links() }}
            </div>
    </div>
</div>
@endsection

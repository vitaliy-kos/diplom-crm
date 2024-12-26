@extends('layouts.crm')

@section('content')
<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mb-4 mt-1">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h4 class="font-weight-bold">
                        @if($request->filter == '')
                            {{ 'Все обращения' }}
                        @elseif($request->filter == 'call')
                            {{ 'Звонки' }}
                        @elseif($request->filter == 'text')
                            {{ 'Заявки на перезвон' }}
                        @endif
                    </h4>
                </div>
            </div>
        </div>

        <form method="GET" action="{{ route('crm.clientRequest.index') }}" class="orders_filter"> 
            <div class="row table_filter mb-2">
                <!-- <input type="hidden" name="filter" value=""> -->

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

                <!-- <div class="col-sm-12 col-md-4 d-flex mb-1">
                <label class="mr-1 mt-1">Поиск: </label>
                <input type="search" name="que" value="{{ $request->get('que') }}" class="form-control form-control-sm" placeholder="Поиск...">
                </div> -->

            </div>
        </form>
        
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-striped table-bordered clients-table table-mobile">
                    <thead>
                        <tr>
                            <th style="width:5%">ID</th>
                            <th style="width:25%">ФИО</th>
                            <th style="width:15%" class="no-sort">Телефон</th>
                            <th style="width:22%" class="no-sort">Тип</th>
                            <th style="width:23%">Дата</th>
                            <th style="width:10%" class="no-sort">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($clientsRequests) > 0)
                            @foreach ($clientsRequests as $clientRequest)
                            <tr>
                                <td data-label="ID клиента">{{ $clientRequest->id }}</td>
                                <td data-label="ФИО">
                                    @if ( $clientRequest->client->first_name || $clientRequest->client->middle_name || $clientRequest->client->last_name )
                                        {{ "{$clientRequest->client->first_name} {$clientRequest->client->middle_name} {$clientRequest->client->last_name}" }}
                                    @else
                                        {{ 'Имя не известно' }}
                                    @endif
                                </td>
                                <td data-label="Номер телефона">
                                    {{ convertPhoneToFormated($clientRequest->from_number) }}
                                </td>
                                <td data-label="Тип">
                                    <div class="city text-center">{{ requstType($clientRequest->type) }}</div>
                                </td>
                                <td data-label="Дата">{{ dateFormatted($clientRequest->date_start) }}</td>
                                <td data-label="Действия">
                                    <div>
                                        <a href="{{ route('crm.clientRequest.show', $clientRequest->id) }}" class="btn btn-outline-success mt-2 sml-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
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
                {{ $clientsRequests->links() }}
            </div>
    </div>
</div>
@endsection

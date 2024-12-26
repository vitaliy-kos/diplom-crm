@extends('layouts.crm')

@section('content')
<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mb-4 mt-1">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h4 class="font-weight-bold">
                        @if(Route::is('crm.client.index'))
                            {{ 'Клиенты' }}
                        @elseif(Route::is('crm.client.spam'))
                            {{ 'Клиенты в спаме' }}
                        @elseif(Route::is('crm.client.deleted'))
                            {{ 'Удаленные клиенты' }}
                        @endif
                    </h4>
                    <a href="{{ route('crm.client.create') }}" class="btn btn-outline-primary mt-2">Создать клиента</a>
                </div>
            </div>
        </div>

        <form method="GET" action="{{ route('crm.client.index') }}" class="orders_filter"> 
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
                            <th style="width:5%">ID</th>
                            <th style="width:25%">ФИО</th>
                            <th style="width:22%" class="no-sort">Номер телефона</th>
                            <th style="width:15%">Город</th>
                            <th style="width:15%" class="no-sort">Адрес</th>
                            <th style="width:18%" class="no-sort">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($clients)
                            @foreach ($clients as $client)
                            <tr>
                                <td data-label="ID клиента">{{ $client->id }}</td>
                                <td data-label="ФИО">
                                    @if ( $client->first_name || $client->middle_name || $client->last_name )
                                        {{ "{$client->first_name} {$client->middle_name} {$client->last_name}" }}
                                    @else
                                        {{ 'Имя не известно' }}
                                    @endif
                                </td>
                                <td data-label="Номер телефона">
                                    {{ convertPhoneToFormated($client->phone) }}
                                   
                                    @if($client->additional_phone) 
                                        <br>
                                        {{ convertPhoneToFormated($client->additional_phone) }}
                                    @endif
                                </td>
                                <td data-label="Город">
                                    <div class="city text-center">{{ $client->city->name_ru ?? 'Не выбран' }}</div>
                                </td>
                                <td data-label="Адрес">{{ convertAddressToString($client->address) }}</td>
                                <td data-label="Действия">
                                    <div>
                                        <a href="{{ route('crm.client.edit', $client->id) }}" class="btn btn-outline-success mt-2 sml-btn">
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
                {{ $clients->links() }}
            </div>
    </div>
</div>
@endsection

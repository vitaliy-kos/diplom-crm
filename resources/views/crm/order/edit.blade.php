@extends('layouts.crm')

@section('content')
<div class="content-page order">
    <div class="container-fluid">
        <div class="row">
            <input type="hidden" name="order_id" value="{{ $order->id }}">
            <input type="hidden" name="token" value="Bearer 12312312312312312">
            <input type="hidden" name="spare_parts_sended" value="{{ $sparePartSended }}">
            <input type="hidden" name="cost_of_parts" value="{{ $order->metaByName('cost_of_parts') }}">
            <input type="hidden" name="got_money" value="{{ $order->metaByName('got_money') }}">

            @if ($order->client->spam)
                @include('includes.templates.spamNotify')
            @endif

            <div class="col-md-12 mb-4 mt-1">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h4 class="font-weight-bold">Заказ
                        <div class="badge badge-pill border border-dark text-dark">№{{ $order->id }}</div>
                        @if ($edit)
                        <a class="ml-1" href="{{ route('crm.client.spam', [$order->client->id, 'order', $order->id]) }}">
                            <div class="badge badge-pill border border-{{ $order->client->spam ? "success" : "danger"}} text-{{ $order->client->spam ? "success" : "danger"}}">
                                {{ $order->client->spam ? "Убрать из спама" : "Добавить в спам" }}
                            </div>
                        </a>
                        @endif
                    </h4>
                    <h6 class="mt-2">Зарегистрирован {{ dateFormatted($order->date_creation) }}</h6>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-8">

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h5 class="card-title">Статус:
                                <div class="mt-2 badge border border-{{ $order->status()->bt_type }} text-{{ $order->status()->bt_type }}">{{ $order->status()->name }}</div>
                            </h5>
                        </div>
                        @if (!$edit && $order->status()->id != 2 && $order->status()->id != 6)
                            <div class="header-action">
                                <a href="{{ route('crm.order.edit', $order->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="card-body pt-0">
                        @if ($errors->any())
                            @include('includes.errors')
                        @endif

                        @if ($edit)

                        <div class="form-row action_button">
                            @if(1 != 1 && $order->status()->id == 0)
                            <div class="col">
                                <a href="{{ route('crm.order.status', [$order->id, 1])}}" class="btn btn-success rounded-pill mt-0">Завершить заказ</a>
                            </div>
                            @endif
                        </div>

                        <div class="form-row action_button">

                            @if($order->status()->id == 1 || $order->status()->id == 2 || $order->status()->id == 3)
                            <div class="col">
                                <a href="{{ route('crm.order.status', [$order->id, 4])}}" class="btn btn-success rounded-pill mt-0">Завершить заказ</a>
                            </div>
                            @endif

                            @if ($order->status()->id != 4 && $order->status()->id != 5)
                            <div class="col">
                                <a href="{{ route('crm.order.status', [$order->id, 5])}}" class="btn btn-danger rounded-pill mt-0">Отменить заказ</a>
                            </div>
                            @endif

                        </div>

                        @endif

                        <form method="POST" action="{{ route('crm.order.update', $order->id) }}" class="">
                            @csrf
                            @method('PATCH')

                            <div class="form-row mt-5">
                                <div class="col-sm-12 col-md-4 text-center">
                                    <label for="client[last_name]">Фамилия</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="client[last_name]"
                                        value="{{ old('client[last_name]', $order->client->last_name) }}"
                                        placeholder="Фамилия"
                                        @if(!$edit) disabled @endif>
                                </div>
                                <div class="col-sm-12 col-md-4 text-center mobile-mt-2">
                                    <label for="client[first_name]">Имя</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="client[first_name]"
                                        value="{{ old('client[first_name]', $order->client->first_name) }}"
                                        placeholder="Имя"
                                        @if(!$edit) disabled @endif>
                                </div>
                                <div class="col-sm-12 col-md-4 text-center mobile-mt-2">
                                    <label for="client[middle_name]">Отчество</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="client[middle_name]"
                                        value="{{ old('client[middle_name]', $order->client->middle_name) }}"
                                        placeholder="Отчество"
                                        @if(!$edit) disabled @endif>
                                </div>
                            </div>

                            <div class="form-row mt-4 pb-3">
                                <div class="col-6 text-center">
                                    <label for="phone">Телефон</label>
                                    <input type="tel" class="form-control" value="{{ $order->client->phone }}" disabled>
                                </div>
                                <div class="col-6 text-center">
                                    <label for="additional_phone">Дополнительный телефон</label>
                                    <input 
                                        type="tel" 
                                        class="form-control" 
                                        name="client[additional_phone]" 
                                        value="{{ $order->client->additional_phone }}" 
                                        placeholder="Дополнительный телефон"
                                        @if(!$edit) disabled @endif>
                                </div>
                            </div>

                            <div class="form-row mt-4 pb-3">
                                <div class="col-6 text-center">
                                    <label for="city_id">Город</label>
                                    <select name="client[city_id]" class="form-control choicesjs"
                                        @if(!$edit) disabled @endif>
                                        <option placeholder>Выберите город</option>
                                        @foreach ($cities as $city)
                                        <option
                                            value="{{ $city->id }}"
                                            @if ($city->id === (int) old('city_id', $order->client->city_id))
                                            selected
                                            @endif
                                            >{{ $city->name_ru }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-6 text-center">
                                    <label for="brand_id">Бренд техники</label>
                                    <select name="order[brand_id]" class="form-control choicesjs"
                                        @if(!$edit) disabled @endif>
                                        <option placeholder>Выберите бренд техники</option>
                                        @foreach ($brands as $brand)
                                        <option
                                            value="{{ $brand->id }}"
                                            @if ($brand->id === (int) old('brand_id', $order->brand_id))
                                            selected
                                            @endif
                                            >{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-6 text-center mt-4">
                                    <label>Станция метро</label>
                                    <select name="address[metro_station_id]" class="form-control choicesjs"
                                        @if(!$edit) disabled @endif>
                                        <option placeholder>Выберите станцию</option>
                                        @foreach ($metroStations as $metroStation)
                                        <option
                                            value="{{ $metroStation->id }}"
                                            @if ($metroStation->id === (int) old('address[metro_station_id]', $order->client->address?->metro_station?->id))
                                            selected
                                            @endif
                                            >{{ $metroStation->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-6 text-center mt-4">
                                    <label>Улица</label>
                                    <div class="date-icon-set">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="address[street]"
                                            value="{{ old('address[street]', $order->client?->address?->street) }}"
                                            placeholder="Улица"
                                            @if(!$edit) disabled @endif>
                                            
                                        <span class="search-link">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-width="2" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                <path stroke-linecap="round" stroke-width="2" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-2 text-center mt-4">
                                    <label>Дом</label>
                                    <div class="date-icon-set">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="address[home]"
                                            value="{{ old('address[home]', $order->client?->address?->home) }}"
                                            placeholder="Дом"
                                            @if(!$edit) disabled @endif>
                                            
                                        <span class="search-link">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path d="M6 19H9V14C9 13.7167 9.096 13.4793 9.288 13.288C9.48 13.0967 9.71733 13.0007 10 13H14C14.2833 13 14.521 13.096 14.713 13.288C14.905 13.48 15.0007 13.7173 15 14V19H18V10L12 5.5L6 10V19ZM4 19V10C4 9.68333 4.071 9.38333 4.213 9.1C4.355 8.81667 4.55067 8.58333 4.8 8.4L10.8 3.9C11.15 3.63333 11.55 3.5 12 3.5C12.45 3.5 12.85 3.63333 13.2 3.9L19.2 8.4C19.45 8.58333 19.646 8.81667 19.788 9.1C19.93 9.38333 20.0007 9.68333 20 10V19C20 19.55 19.804 20.021 19.412 20.413C19.02 20.805 18.5493 21.0007 18 21H14C13.7167 21 13.4793 20.904 13.288 20.712C13.0967 20.52 13.0007 20.2827 13 20V15H11V20C11 20.2833 10.904 20.521 10.712 20.713C10.52 20.905 10.2827 21.0007 10 21H6C5.45 21 4.97933 20.8043 4.588 20.413C4.19667 20.0217 4.00067 19.5507 4 19Z" fill="currentColor"/>
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-2 text-center mt-4">
                                    <label>Подьезд</label>
                                    <div class="date-icon-set">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="address[entrance]"
                                            value="{{ old('address[entrance]', $order->client?->address?->entrance) }}"
                                            placeholder="№"
                                            @if(!$edit) disabled @endif>
                                            
                                        <span class="search-link">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path d="M12 2.5C12.3852 2.50019 12.7556 2.64858 13.0344 2.91441C13.3132 3.18024 13.479 3.54314 13.4975 3.92791C13.516 4.31269 13.3858 4.68983 13.1338 4.9812C12.8818 5.27257 12.5274 5.45583 12.144 5.493L12 5.5H7C6.88297 5.49996 6.76964 5.54097 6.67974 5.61589C6.58984 5.69081 6.52906 5.79489 6.508 5.91L6.5 6V18C6.49996 18.117 6.54097 18.2304 6.61589 18.3203C6.69081 18.4102 6.79489 18.4709 6.91 18.492L7 18.5H11.5C11.8852 18.5002 12.2556 18.6486 12.5344 18.9144C12.8132 19.1802 12.979 19.5431 12.9975 19.9279C13.016 20.3127 12.8858 20.6898 12.6338 20.9812C12.3818 21.2726 12.0274 21.4558 11.644 21.493L11.5 21.5H7C6.10493 21.5001 5.24385 21.1572 4.59379 20.5419C3.94373 19.9267 3.5541 19.0857 3.505 18.192L3.5 18V6C3.49993 5.10493 3.84278 4.24385 4.45806 3.59379C5.07334 2.94373 5.91428 2.5541 6.808 2.505L7 2.5H12ZM13.94 8.11C14.2118 7.83723 14.5781 7.67943 14.963 7.66927C15.3479 7.6591 15.722 7.79736 16.0078 8.0554C16.2936 8.31344 16.4692 8.67151 16.4983 9.05547C16.5274 9.43942 16.4077 9.81986 16.164 10.118L16.061 10.232L15.793 10.5H20C20.3852 10.5002 20.7556 10.6486 21.0344 10.9144C21.3132 11.1802 21.479 11.5431 21.4975 11.9279C21.516 12.3127 21.3858 12.6898 21.1338 12.9812C20.8818 13.2726 20.5274 13.4558 20.144 13.493L20 13.5H15.793L16.061 13.768C16.3338 14.0398 16.4916 14.4061 16.5017 14.791C16.5119 15.1759 16.3736 15.55 16.1156 15.8358C15.8576 16.1216 15.4995 16.2972 15.1155 16.3263C14.7316 16.3554 14.3511 16.2357 14.053 15.992L13.939 15.889L11.111 13.061C10.8483 12.7984 10.6923 12.4478 10.6733 12.0768C10.6542 11.7059 10.7735 11.3411 11.008 11.053L11.111 10.939L13.939 8.111L13.94 8.11Z" fill="currentColor"/>
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-3 text-center mt-4">
                                    <label>Кваритра</label>
                                    <div class="date-icon-set">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="address[flat]"
                                            value="{{ old('address[flat]', $order->client?->address?->flat) }}"
                                            placeholder="Квартира"
                                            @if(!$edit) disabled @endif>
                                            
                                        <span class="search-link">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path d="M17 3C17.5304 3 18.0391 3.21071 18.4142 3.58579C18.7893 3.96086 19 4.46957 19 5V19H20C20.2652 19 20.5196 19.1054 20.7071 19.2929C20.8946 19.4804 21 19.7348 21 20C21 20.2652 20.8946 20.5196 20.7071 20.7071C20.5196 20.8946 20.2652 21 20 21H4C3.73478 21 3.48043 20.8946 3.29289 20.7071C3.10536 20.5196 3 20.2652 3 20C3 19.7348 3.10536 19.4804 3.29289 19.2929C3.48043 19.1054 3.73478 19 4 19H5V5C5 4.46957 5.21071 3.96086 5.58579 3.58579C5.96086 3.21071 6.46957 3 7 3H17ZM17 5H7V19H17V5ZM14.5 11C14.697 11 14.892 11.0388 15.074 11.1142C15.256 11.1896 15.4214 11.3001 15.5607 11.4393C15.6999 11.5786 15.8104 11.744 15.8858 11.926C15.9612 12.108 16 12.303 16 12.5C16 12.697 15.9612 12.892 15.8858 13.074C15.8104 13.256 15.6999 13.4214 15.5607 13.5607C15.4214 13.6999 15.256 13.8104 15.074 13.8858C14.892 13.9612 14.697 14 14.5 14C14.1022 14 13.7206 13.842 13.4393 13.5607C13.158 13.2794 13 12.8978 13 12.5C13 12.1022 13.158 11.7206 13.4393 11.4393C13.7206 11.158 14.1022 11 14.5 11Z" fill="currentColor"/>
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-2 text-center mt-4">
                                    <label>Этаж</label>
                                    <div class="date-icon-set">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="address[floor]"
                                            value="{{ old('address[floor]', $order->client?->address?->floor) }}"
                                            placeholder="Этаж"
                                            @if(!$edit) disabled @endif>
                                            
                                        <span class="search-link">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path d="M6.5 20V16.5C6.5 16.2167 6.596 15.9793 6.788 15.788C6.98 15.5967 7.21734 15.5007 7.5 15.5H11V12C11 11.7167 11.096 11.4793 11.288 11.288C11.48 11.0967 11.7173 11.0007 12 11H15.5V7.5C15.5 7.21667 15.596 6.97934 15.788 6.788C15.98 6.59667 16.2173 6.50067 16.5 6.5H20V4C20 3.71667 20.096 3.47934 20.288 3.288C20.48 3.09667 20.7173 3.00067 21 3C21.2827 2.99934 21.5203 3.09534 21.713 3.288C21.9057 3.48067 22.0013 3.718 22 4V7.5C22 7.78334 21.904 8.021 21.712 8.213C21.52 8.405 21.2827 8.50067 21 8.5H17.5V12C17.5 12.2833 17.404 12.521 17.212 12.713C17.02 12.905 16.7827 13.0007 16.5 13H13V16.5C13 16.7833 12.904 17.021 12.712 17.213C12.52 17.405 12.2827 17.5007 12 17.5H8.5V21C8.5 21.2833 8.404 21.521 8.212 21.713C8.02 21.905 7.78267 22.0007 7.5 22H4C3.71667 22 3.47934 21.904 3.288 21.712C3.09667 21.52 3.00067 21.2827 3 21C2.99934 20.7173 3.09534 20.48 3.288 20.288C3.48067 20.096 3.718 20 4 20H6.5Z" fill="currentColor"/>
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-3 text-center mt-4">
                                    <label>Домофон</label>
                                    <div class="date-icon-set">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="address[code]"
                                            value="{{ old('address[code]', $order->client?->address?->code) }}"
                                            placeholder="Код"
                                            @if(!$edit) disabled @endif>
                                            
                                        <span class="search-link">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" width="20">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 0 1-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0 1 12 18.375m9.75-12.75c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125m19.5 0v1.5c0 .621-.504 1.125-1.125 1.125M2.25 5.625v1.5c0 .621.504 1.125 1.125 1.125m0 0h17.25m-17.25 0h7.5c.621 0 1.125.504 1.125 1.125M3.375 8.25c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m17.25-3.75h-7.5c-.621 0-1.125.504-1.125 1.125m8.625-1.125c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M12 10.875v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125M13.125 12h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125M20.625 12c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5M12 14.625v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 14.625c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m0 1.5v-1.5m0 0c0-.621.504-1.125 1.125-1.125m0 0h7.5" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                            </div>

                            <hr>

                            <div class="form-row mt-5">

                                <div class="col-6 text-center">
                                    <label for="city">Тип оборудования</label>
                                    <select name="order[technic_type_id]" class="form-control choicesjs"
                                        @if(!$edit) disabled @endif>
                                        <option placeholder>Выберите тип оборудования</option>
                                        @foreach ($technicsTypes as $technicsType)
                                        <option
                                            value="{{ $technicsType->id }}"
                                            @if ($technicsType->id === (int) old('technic_type_id', $order->technic_type_id))
                                            selected
                                            @endif
                                            >{{ $technicsType->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-6 text-center">
                                    <label for="city">Неисправность</label>
                                    <select
                                        name="order[broken_type_id]"
                                        class="form-control choicesjs"
                                        data-class="hidden_options"
                                        @if(!old('broken_type_id', $order->broken_type_id)) disabled @endif>
                                        <option placeholder>Выберите неисправность</option>
                                        @foreach ($brokenTypes as $brokenType)
                                        <option
                                            value="{{ $brokenType->id }}" data-type="{{ $brokenType->	technic_type_id }}"
                                            @if ($brokenType->id === (int) old('broken_type_id', $order->broken_type_id))
                                            selected
                                            @endif
                                            >{{ $brokenType->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="form-row mt-3">
                                <div class="col-6 text-center">
                                    <label for="city">Возраст техники</label>
                                    <select 
                                        name="order[ages_of_technic]" 
                                        class="form-control choicesjs sort-value"
                                        @if(!$edit || (old('ages_of_technic', $order->ages_of_technic) < 500 && old('ages_of_technic', $order->ages_of_technic) != null)) disabled @endif>
                                        <option placeholder>Выберите возраст техники</option>
                                        @foreach ($agesTechnic as $ageTechnic)
                                        <option
                                            value="{{ $ageTechnic->value }}"
                                            @if ((int) $ageTechnic->value === (int) old('ages_of_technic', $order->ages_of_technic))
                                            selected
                                            @endif
                                            >{{ $ageTechnic->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-6 text-center">
                                    <label for="ages_of_technic">Точный возраст</label>
                                    <input
                                        type="text"
                                        class="form-control ages_of_technic"
                                        name="order[ages_of_technic]"
                                        value="@if(old('client[ages_of_technic]', $order->ages_of_technic) < 500){{ old('client[ages_of_technic]', $order->ages_of_technic) }}@endif"
                                        maxlength="2"
                                        placeholder="Точный возраст техники"
                                        @if(!$edit || $order->ages_of_technic >= 500) disabled @endif>
                                </div>
                            </div>

                            <br>
                            <hr>

                            <div class="form-row mt-4">
                                
                                <div class="col-6 text-center">
                                    <label for="first_name">Дата выезда мастера</label>
                                    <div class="date-icon-set">
                                        <input
                                            type="text"
                                            name="order[date_of_repair]"
                                            id="DateOfFix"
                                            class="form-control"
                                            placeholder="Дата выезда"
                                            value="{{ parseDate(old('date_of_repair', $order->date_of_repair)) }}"
                                            inputmode="none">
                                    </div>
                                </div>

                                <div class="col-6 text-center">
                                    <label for="time_of_repair">Время выезда</label>
                                    <div class="date-icon-set">
                                        <input
                                            type="text"
                                            class="form-control time"
                                            name="order[time_of_repair]"
                                            value="{{ parseTime(old('time_of_repair', $order->date_of_repair)) }}"
                                            placeholder="Время выезда"
                                            @if(!$edit) disabled @endif>

                                        <span class="search-link">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                            </div>

                            <div class="mt-4">
                                <div class="form-group text-center">
                                    <label for="comment">Комментарий к заказу</label>
                                    <textarea class="form-control order_comment" name="order[comment]" rows="2" @if(!$edit) disabled @endif>{{ $order->comment }}</textarea>
                                </div>
                            </div>

                            <div class="mt-3 d-flex justify-content-between align-items-center">

                                <a href="<?= route('crm.client.show', $order->client->id) ?>">
                                    <div class="badge badge-pill border border-info text-info">ID клиента {{ $order->client->id }}</div>
                                </a>
                                
                                @if ($edit)
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                                @endif

                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <div class="col-md-12 col-lg-4">

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h5 class="card-title">Обращения клиента</h5>
                        </div>
                    </div>
                    <div class="card-body">

                        <ul class="requests_in_client list-group">
                            @if ($order->requests && count($order->requests))
                            @foreach ($order->requests as $clientRequest)

                            <li class="list-group-item list-group-item-action">

                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{ requstType($clientRequest->type) }}</h5>
                                    <small class="text-muted">
                                        @if ($clientRequest->type == 'call' && $clientRequest->duration_call > 0) 
                                            {{ convertSecondsToMinutes($clientRequest->duration_call) }}
                                        @elseif ($clientRequest->type == 'call' && $clientRequest->duration_call == 0)
                                            Идет разговор
                                        @endif
                                    </small>
                                </div>

                                <p class="mb-1">{{ dateFormatted($clientRequest->date_start) }}</p>
                                <small class="text-muted"><a href="<?= route('crm.clientRequest.show', $clientRequest->id) ?>">Перейти к обращению</a></small>

                                @if ($clientRequest->type == 'call' && !empty($clientRequest->unique_key) && $clientRequest->duration_call > 0 )
                                <div class="audio" data-unique="<?php echo $clientRequest->unique_key ?>">
                                    <div class="loader-audio"></div>
                                </div>
                                @endif

                            </li>
                            @endforeach
                            @else
                                Обращения не найдены
                            @endif
                        </ul>


                    </div>
                </div>
                
                
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h5>Маркетинг</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                @if ($order->site)
                                    <tr>
                                        <td>Сайт</td>
                                        <td><a href="{{ route('crm.site.show', $order->site->id) }}" target="_blank">{{ $order->site->name }}</a></td>
                                    </tr>
                                @endif
                                @foreach ($order->metas as $meta)
                                    @if ($meta->key == 'ip')
                                        <tr>
                                            <td>
                                                @if ($meta->key == 'utm')
                                                UTM
                                                @elseif ($meta->key == 'uid')
                                                UID
                                                @elseif ($meta->key == 'site')
                                                Сайт
                                                @elseif ($meta->key == 'service_in_ad')
                                                Услуга на сайте
                                                @elseif ($meta->key == 'city_in_ad')
                                                Город на сайте
                                                @elseif ($meta->key == 'ip')
                                                IP
                                                @endif
                                            </td>
                                            <td><?php
                                                // if ($meta['name'] == 'utm') {
                                                //     $json = json_decode(stripslashes($meta['value']));
                                                //     if (is_array($json)) {
                                                //     foreach ($json as $str) {
                                                //         foreach ($str as $key => $val) {
                                                //             echo "$key: $val <br>";
                                                //         }
                                                //     }
                                                //     } else {
                                                //     if ($json) {
                                                //         foreach ($json as $k => $v) {
                                                //             echo "$k: $v <br>";
                                                //         }
                                                //     }
                                                //     }

                                                // } else {
                                                    echo $meta->value;
                                                // }

                                                ?></td>
                                        </tr>
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

                @include('includes.logs')

                @if( $edit && $order->status()->id != 0 && $order->status()->id != 6)
                    <div class="card card-block">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h5>Откат заявки</h5>
                            </div>
                        </div>
                        <div class="card-body text-center">

                            <a href="{{ route('crm.order.show', $order->status()->id) }}" class="btn btn-danger rounded-pill mt-0">Откатить к статусу "В работе"</a>

                        </div>
                    </div>
                @endif

                
            </div>

            
        </div>        

        @if ($sparePartSended) 
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h5 class="card-title">Приход по заказу</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-services overflow two-rows">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center" style="width:25%">Услуга</th>
                                    <th scope="col" class="text-center" style="width:15%">Сумма чека</th>
                                    <th scope="col" class="text-center" style="width:15%">Остаток</th>
                                    <th scope="col" class="text-center" style="width:15%">Процент</th>
                                    <th scope="col" class="text-center" style="width:15%">Прибыль</th>
                                    <th scope="col" class="text-center" style="width:10%">Оплачено</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card spare-parts">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h5 class="card-title">Расчет и запчасти</h5>
                        </div>
                        <div class="btn btn-primary ml-3 send_spare_parts {{ $sparePartSended ? 'disabled' : '' }}">
                            @if ($sparePartSended) 
                                Расчет отправлен
                            @else
                                Отправить расчет
                            @endif
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="d-flex jsustify-content-start align-items-center">
                            <label for="city" class="col-sm-3">Принято денег от клиента</label>

                            <div class="input-group col-sm-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₽</span>
                                </div>
                                <input 
                                    type="text" 
                                    name="got_money" 
                                    class="form-control form-control-lg got_money"
                                    style="font-size: 26px;text-align: center;" 
                                    aria-label="Сумма" 
                                    maxlength="7" 
                                    value="{{ $order->metaByName('got_money') }}" 
                                    inputmode="numeric"
                                    {{ $sparePartSended ? 'disabled' : '' }}>
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>

                        <br>
                        <hr>
                        <br>

                        <table class="table table-spare-parts overflow two-rows">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center" style="width:35%">Запчасть</th>
                                    <th scope="col" class="text-center" style="width:20%">Цена</th>
                                    <th scope="col" class="text-center" style="width:15%">Количество</th>
                                    <th scope="col" class="text-center" style="width:20%">Итого</th>
                                    <th scope="col" class="text-center" style="width:10%">Удалить</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="loader">
                                    <td colspan="5">
                                        <img src="{{ asset('/assets/images/loader-black.svg') }}" class="preloader w-100" height="100">
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <div class="btn btn-primary add_spare_part {{ $sparePartSended ? 'd-none' : '' }}">Добавить запчасть</div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

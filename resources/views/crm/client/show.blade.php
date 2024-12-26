@extends('layouts.crm')

@section('content')
<div class="content-page">
    <div class="container-fluid">

        @if ($client->spam)
            @include('includes.templates.spamNotify')
        @endif

        <div class="row">
            <div class="col-md-12 mb-4 mt-1">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h4 class="font-weight-bold">Просмотр клиента
                        <div class="badge badge-pill border border-dark text-dark">ID {{ $client->id }}</div>

                        <a href="{{ route('crm.client.index') }}">
                            <div class="badge badge-pill border border-dark text-dark">Назад</div>
                        </a>
                    </h4>
                    <h6 class="mt-2">Создан {{ $client->created_at }}</h6>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h5 class="card-title">Информация о клиенте</h5>
                        </div>
                        <a href="{{ route('crm.client.edit', $client->id) }}" class="btn btn-outline-success sml-btn but-square p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </a>
                    </div>

                    <div class="card-body">

                        <form>
                            <div class="form-row mt-3">
                                <div class="col">
                                    <label for="last_name">Фамилия</label>
                                    <input type="text" class="form-control" name="last_name" value="{{  $client->last_name }}" disabled>
                                </div>
                                <div class="col">
                                    <label for="first_name">Имя</label>
                                    <input type="text" class="form-control" name="first_name" value="{{  $client->first_name }}" disabled>
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col">
                                    <label for="middle_name">Отчество</label>
                                    <input type="text" class="form-control" name="middle_name" value="{{ $client->middle_name }}" disabled>
                                </div>
                                <div class="col">
                                    <label for="city">Город</label>
                                    <select name="city_id" class="form-control choicesjs" disabled>
                                        <option placeholder>Выберите город</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}" {{ $city->id === (int) $client->city_id ? 'selected' : '' }}>{{ $city->name_ru }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-row mt-3">
                                <div class="col">
                                    <label for="phone">Телефон</label>
                                    <input type="tel" class="form-control" name="phone" value="{{  $client->phone }}" disabled>
                                </div>
                                <div class="col">
                                    <label for="additional_phone">Дополнительный телефон</label>
                                    <input type="tel" class="form-control" name="additional_phone" value="{{ $client->additional_phone }}" disabled>
                                </div>
                            </div>
                            
                            <div class="form-row mt-3">
                                <div class="col">
                                    <label>Станция метро</label>
                                    <select name="address[metro_station_id]" class="form-control choicesjs" disabled>
                                        <option placeholder>Выберите станцию</option>
                                        @foreach ($metroStations as $metroStation)
                                        <option
                                            value="{{ $metroStation->id }}"
                                            @if ($metroStation->id === (int) old('address[metro_station_id]', $client->address?->metro_station?->id))
                                            selected
                                            @endif
                                            >{{ $metroStation->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col">
                                    <label>Улица</label>
                                    <div class="date-icon-set">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="address[street]"
                                            value="{{ old('address[street]', $client->address?->street) }}"
                                            placeholder="Улица"
                                            disabled>
                                            
                                        <span class="search-link">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-width="2" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                <path stroke-linecap="round" stroke-width="2" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-row mt-3">
                                <div class="col-2">
                                    <label>Дом</label>
                                    <div class="date-icon-set">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="address[home]"
                                            value="{{ old('address[home]', $client->address?->home) }}"
                                            placeholder="Дом"
                                            disabled>
                                            
                                        <span class="search-link">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path d="M6 19H9V14C9 13.7167 9.096 13.4793 9.288 13.288C9.48 13.0967 9.71733 13.0007 10 13H14C14.2833 13 14.521 13.096 14.713 13.288C14.905 13.48 15.0007 13.7173 15 14V19H18V10L12 5.5L6 10V19ZM4 19V10C4 9.68333 4.071 9.38333 4.213 9.1C4.355 8.81667 4.55067 8.58333 4.8 8.4L10.8 3.9C11.15 3.63333 11.55 3.5 12 3.5C12.45 3.5 12.85 3.63333 13.2 3.9L19.2 8.4C19.45 8.58333 19.646 8.81667 19.788 9.1C19.93 9.38333 20.0007 9.68333 20 10V19C20 19.55 19.804 20.021 19.412 20.413C19.02 20.805 18.5493 21.0007 18 21H14C13.7167 21 13.4793 20.904 13.288 20.712C13.0967 20.52 13.0007 20.2827 13 20V15H11V20C11 20.2833 10.904 20.521 10.712 20.713C10.52 20.905 10.2827 21.0007 10 21H6C5.45 21 4.97933 20.8043 4.588 20.413C4.19667 20.0217 4.00067 19.5507 4 19Z" fill="currentColor"/>
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <label>Подьезд</label>
                                    <div class="date-icon-set">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="address[entrance]"
                                            value="{{ old('address[entrance]', $client->address?->entrance) }}"
                                            placeholder="№"
                                            disabled>
                                            
                                        <span class="search-link">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path d="M12 2.5C12.3852 2.50019 12.7556 2.64858 13.0344 2.91441C13.3132 3.18024 13.479 3.54314 13.4975 3.92791C13.516 4.31269 13.3858 4.68983 13.1338 4.9812C12.8818 5.27257 12.5274 5.45583 12.144 5.493L12 5.5H7C6.88297 5.49996 6.76964 5.54097 6.67974 5.61589C6.58984 5.69081 6.52906 5.79489 6.508 5.91L6.5 6V18C6.49996 18.117 6.54097 18.2304 6.61589 18.3203C6.69081 18.4102 6.79489 18.4709 6.91 18.492L7 18.5H11.5C11.8852 18.5002 12.2556 18.6486 12.5344 18.9144C12.8132 19.1802 12.979 19.5431 12.9975 19.9279C13.016 20.3127 12.8858 20.6898 12.6338 20.9812C12.3818 21.2726 12.0274 21.4558 11.644 21.493L11.5 21.5H7C6.10493 21.5001 5.24385 21.1572 4.59379 20.5419C3.94373 19.9267 3.5541 19.0857 3.505 18.192L3.5 18V6C3.49993 5.10493 3.84278 4.24385 4.45806 3.59379C5.07334 2.94373 5.91428 2.5541 6.808 2.505L7 2.5H12ZM13.94 8.11C14.2118 7.83723 14.5781 7.67943 14.963 7.66927C15.3479 7.6591 15.722 7.79736 16.0078 8.0554C16.2936 8.31344 16.4692 8.67151 16.4983 9.05547C16.5274 9.43942 16.4077 9.81986 16.164 10.118L16.061 10.232L15.793 10.5H20C20.3852 10.5002 20.7556 10.6486 21.0344 10.9144C21.3132 11.1802 21.479 11.5431 21.4975 11.9279C21.516 12.3127 21.3858 12.6898 21.1338 12.9812C20.8818 13.2726 20.5274 13.4558 20.144 13.493L20 13.5H15.793L16.061 13.768C16.3338 14.0398 16.4916 14.4061 16.5017 14.791C16.5119 15.1759 16.3736 15.55 16.1156 15.8358C15.8576 16.1216 15.4995 16.2972 15.1155 16.3263C14.7316 16.3554 14.3511 16.2357 14.053 15.992L13.939 15.889L11.111 13.061C10.8483 12.7984 10.6923 12.4478 10.6733 12.0768C10.6542 11.7059 10.7735 11.3411 11.008 11.053L11.111 10.939L13.939 8.111L13.94 8.11Z" fill="currentColor"/>
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <label>Кваритра</label>
                                    <div class="date-icon-set">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="address[flat]"
                                            value="{{ old('address[flat]', $client->address?->flat) }}"
                                            placeholder="Квартира"
                                            disabled>
                                            
                                        <span class="search-link">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path d="M17 3C17.5304 3 18.0391 3.21071 18.4142 3.58579C18.7893 3.96086 19 4.46957 19 5V19H20C20.2652 19 20.5196 19.1054 20.7071 19.2929C20.8946 19.4804 21 19.7348 21 20C21 20.2652 20.8946 20.5196 20.7071 20.7071C20.5196 20.8946 20.2652 21 20 21H4C3.73478 21 3.48043 20.8946 3.29289 20.7071C3.10536 20.5196 3 20.2652 3 20C3 19.7348 3.10536 19.4804 3.29289 19.2929C3.48043 19.1054 3.73478 19 4 19H5V5C5 4.46957 5.21071 3.96086 5.58579 3.58579C5.96086 3.21071 6.46957 3 7 3H17ZM17 5H7V19H17V5ZM14.5 11C14.697 11 14.892 11.0388 15.074 11.1142C15.256 11.1896 15.4214 11.3001 15.5607 11.4393C15.6999 11.5786 15.8104 11.744 15.8858 11.926C15.9612 12.108 16 12.303 16 12.5C16 12.697 15.9612 12.892 15.8858 13.074C15.8104 13.256 15.6999 13.4214 15.5607 13.5607C15.4214 13.6999 15.256 13.8104 15.074 13.8858C14.892 13.9612 14.697 14 14.5 14C14.1022 14 13.7206 13.842 13.4393 13.5607C13.158 13.2794 13 12.8978 13 12.5C13 12.1022 13.158 11.7206 13.4393 11.4393C13.7206 11.158 14.1022 11 14.5 11Z" fill="currentColor"/>
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <label>Этаж</label>
                                    <div class="date-icon-set">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="address[floor]"
                                            value="{{ old('address[floor]', $client->address?->floor) }}"
                                            placeholder="Этаж"
                                            disabled>
                                            
                                        <span class="search-link">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path d="M6.5 20V16.5C6.5 16.2167 6.596 15.9793 6.788 15.788C6.98 15.5967 7.21734 15.5007 7.5 15.5H11V12C11 11.7167 11.096 11.4793 11.288 11.288C11.48 11.0967 11.7173 11.0007 12 11H15.5V7.5C15.5 7.21667 15.596 6.97934 15.788 6.788C15.98 6.59667 16.2173 6.50067 16.5 6.5H20V4C20 3.71667 20.096 3.47934 20.288 3.288C20.48 3.09667 20.7173 3.00067 21 3C21.2827 2.99934 21.5203 3.09534 21.713 3.288C21.9057 3.48067 22.0013 3.718 22 4V7.5C22 7.78334 21.904 8.021 21.712 8.213C21.52 8.405 21.2827 8.50067 21 8.5H17.5V12C17.5 12.2833 17.404 12.521 17.212 12.713C17.02 12.905 16.7827 13.0007 16.5 13H13V16.5C13 16.7833 12.904 17.021 12.712 17.213C12.52 17.405 12.2827 17.5007 12 17.5H8.5V21C8.5 21.2833 8.404 21.521 8.212 21.713C8.02 21.905 7.78267 22.0007 7.5 22H4C3.71667 22 3.47934 21.904 3.288 21.712C3.09667 21.52 3.00067 21.2827 3 21C2.99934 20.7173 3.09534 20.48 3.288 20.288C3.48067 20.096 3.718 20 4 20H6.5Z" fill="currentColor"/>
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <label>Домофон</label>
                                    <div class="date-icon-set">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="address[code]"
                                            value="{{ old('address[code]', $client->address?->code) }}"
                                            placeholder="Код"
                                            disabled>
                                            
                                        <span class="search-link">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" width="20">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 0 1-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0 1 12 18.375m9.75-12.75c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125m19.5 0v1.5c0 .621-.504 1.125-1.125 1.125M2.25 5.625v1.5c0 .621.504 1.125 1.125 1.125m0 0h17.25m-17.25 0h7.5c.621 0 1.125.504 1.125 1.125M3.375 8.25c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m17.25-3.75h-7.5c-.621 0-1.125.504-1.125 1.125m8.625-1.125c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M12 10.875v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125M13.125 12h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125M20.625 12c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5M12 14.625v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 14.625c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m0 1.5v-1.5m0 0c0-.621.504-1.125 1.125-1.125m0 0h7.5" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <div class="form-group">
                                    <label for="comment">Комментарий</label>
                                    <textarea class="form-control" name="comment" rows="3" disabled>{{ $client->comment }}</textarea>
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

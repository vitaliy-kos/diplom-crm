@extends('layouts.crm')

@section('content')
<div class="content-page">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12 mb-4 mt-1">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h4 class="font-weight-bold">Телефон
                        <div class="badge badge-pill border border-dark text-dark">ID {{ $phone->id }}</div>

                        <a href="{{ route('crm.phone.index') }}">
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
                            <h5 class="card-title">Информация о телефоне</h5>
                        </div>
                        <a href="{{ route('crm.phone.edit', $phone->id) }}" class="btn btn-outline-success sml-btn but-square p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </a>
                    </div>
                    <div class="card-body">

                        <div class="form-row mt-3">
                            <div class="col">
                                <label for="last_name">Телефон</label>
                                <input type="tel" class="form-control" name="number" value="{{ $phone->number }}" disabled>
                            </div>
                        </div>

                        <div class="form-row mt-3">
                            <div class="col">
                                <label for="city">Сайт</label>
                                <select name="site_id" class="form-control choicesjs" disabled>
                                    <option placeholder>Выберите сайт</option>
                                    @foreach ($sites as $site)
                                        <option value="{{ $site->id }}" {{ $site->id === $phone->site_id ? 'selected' : '' }}>{{ "{$site->name} - {$site->url}" }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </div>

                @include('includes.logs')

            </div>
        </div>


    </div>
</div>
@endsection

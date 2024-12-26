@extends('layouts.error')

@section('content')
<div class="wrapper">
    <div class="container">
        <div class="row no-gutters height-self-center">
            <div class="col-sm-12 text-center align-self-center">
                <div class="iq-error position-relative">
                    <img src="{{ asset('/assets/images/error/Datum_404.png') }}" class="img-fluid iq-error-img iq-error-img-dark mx-auto" alt="">
                    <img src="{{ asset('/assets/images/error/Datum_404.png') }}"  class="img-fluid iq-error-img mb-0" alt="">
                    <h2 class="mb-0">Кажется, ничего не найдено.</h2>
                    <p class="mt-3">Запрошенная страница не существует.</p>
                    <a class="btn btn-primary d-inline-flex align-items-center mt-3" href="{{ route('crm.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" style="width:20px;margin-right:10px;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        На главную</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

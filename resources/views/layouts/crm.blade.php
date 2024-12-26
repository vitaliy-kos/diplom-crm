<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport"
              content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
        <meta name="format-detection" content="telephone=no">
        <title><?="Any-crm"?></title>
        <link rel="stylesheet" href="{{ asset('/assets/css/backend-plugin.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/assets/css/backend.css') }}">
        <link rel="shortcut icon" href="{{ asset('/assets/images/favicon.ico') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/assets/images/logos/16.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/assets/images/logos/32.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('/assets/images/logos/60.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/assets/images/logos/76.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('/assets/images/logos/120.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('/assets/images/logos/152.png') }}">
    </head>
    <body class="">
        <div id="loading">
            <div id="loading-center"></div>
        </div>

        <div class="wrapper">

            @include('includes.left_menu')

            @include('includes.top_menu')

            @yield('content')

        </div>

        <footer class="iq-footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6"></div>
                    <div class="col-lg-6 text-right">
                        <span class="mr-1">
                            <a href="https://any-media.ru" target="_blank">Any-crm</a>
                        </span>
                    </div>
                </div>
            </div>
        </footer>

        <div id="iconModal" class="modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Выбор иконки</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body"></div>
                </div>
            </div>
        </div>


        <script src="{{ asset('/assets/js/backend-bundle.min.js') }}"></script>
        <script src="{{ asset('/assets/js/mask.js') }}"></script>

        <!-- Chart Custom JavaScript -->
        <script src="{{ asset('/assets/js/chart-custom.js') }}"></script>
        <script src="{{ asset('/assets/js/charts/01.js') }}"></script>
        <script src="{{ asset('/assets/js/charts/02.js') }}"></script>

        <!-- app JavaScript -->
        <script src="{{ asset('/assets/js/app.js') }}"></script>
        <script src="{{ asset('/assets/js/choice.min.js') }}"></script>

        <script type="module" src="/assets/js/order/services.js"></script>
        <script type="module" src="/assets/js/order/spare-parts.js"></script>
        <script type="module" src="/assets/js/order/get-audio.js"></script>
        <script type="module" src="/assets/js/setting/index.js"></script>

    </body>
</html>


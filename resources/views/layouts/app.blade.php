<!DOCTYPE html>
<html lang="es" data-topbar-color="dark">

<head>
    <meta charset="utf-8" />
    <title>mi pagina</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @yield('css')

    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ url('css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">
</head>

<body>
    <div id="wrapper">
        @include('layouts.components.sidebar')
        <div class="content-page">
            @include('layouts.components.navbar')

            <div class="content">
                @yield('contenido')
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"></h4>
                            </div>
                            @yield('content')
                        </div>
                    </div>

                </div>
            </div>
            @include('layouts.components.footer')
        </div>
    </div>

    <script src="{{ url('js/vendor.min.js') }}"></script>
    <script src="{{ url('js/app.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>


        function countNotifications() {
            $.ajax({
                url: '/notificaciones/contar',
                type: 'GET',
                success: function(response) {
                    const item = document.getElementById('countNotification')

                    if (item) {
                        item.innerHTML = response.countNotifications
                    }

                },
            });
        }

        countNotifications()

        var intervalID = setInterval(countNotifications, 15000)
    </script>
    @yield('js')
</body>

</html>

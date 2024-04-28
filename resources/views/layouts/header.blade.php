<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/content.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">

</head>
<body>
<div class="container">
    <div class="header row">
        <nav class="navbar navbar-expand-lg navbar-dark ">
            <a class="navbar-brand" href="{{ route('parking.index') }}">
                <img src="{{ asset('assets/css/img/logo.svg')}}" alt="Avatar Logo" style="width:40px;" class="pill">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('parking.index') }}">Головна</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('reservation.index') }}">Бронювання</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.profile.index')}}">Профіль</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.map.index')}}">Мапа</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about.index') }}">Про нас</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <button class="nav-link btn" type="submit">Вийти</button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    @yield('content')

</div>
@stack('js')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="assets/js/header.js"></script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
@stack('calendarVariable')
<script>
    $(document).ready(function () {
    $(function () {
        $('input[name="daterange"]').daterangepicker({
            "timePicker": true,
            "timePicker24Hour": true,
            "startDate": start,
            "endDate": end,
            locale: {
                format: "DD-MM-YYYY HH:mm"
            }
        });
        $('input[name="daterange"]').on('apply.daterangepicker', function (ev, picker) {
            var format = 'DD-MM-YYYY HH:mm';
            var startDate = picker.startDate.format(format);
            var endDate = picker.endDate.format(format);
            $(this).val(startDate + ' - ' + endDate);
            var address = $('#search-input').val();
            // Сформувати URL з адресою та параметрами дати та часу
            var url = '/parkings?start_date=' + encodeURIComponent(startDate) + '&end_date=' + encodeURIComponent(endDate);
            if (address.trim() !== '') {
                url += '&address=' + encodeURIComponent(address);
            }
            window.location.href = url;
        });

        $('input[name="daterange"]').on('cancel.daterangepicker', function (ev, picker) {
            $(this).val('');
        });

    });});
</script>

<script>
    $(document).ready(function () {
        $('#search-input').on('input', function () {
            var address = $(this).val();

            if (address.trim() === '') {
                $('#search-results').empty();
                return;
            }

            $.ajax({
                url: '{{ route('search') }}',
                type: 'GET',
                data: {address: address},
                success: function (response) {
                    $('#search-results').empty();
                    response.forEach(function (parking) {
                        $('#search-results').append('<li data-id="' + parking.id + '">' + parking.address + '</li>');
                    });
                }
            });
        });

        $('#search-results').on('click', 'li', function () {
            // Отримуємо текст з натиснутого результату
            var address = $(this).text();
            // Заповнюємо інпут значенням адреси
            $('#search-input').val(address);
            var startDate = $('input[name="daterange"]').data('daterangepicker').startDate.format('DD-MM-YYYY HH:mm');
            var endDate = $('input[name="daterange"]').data('daterangepicker').endDate.format('DD-MM-YYYY HH:mm');

            var url = '/parkings?start_date=' + encodeURIComponent(startDate) + '&end_date=' + encodeURIComponent(endDate);
            if (address.trim() !== '') {
                url += '&address=' + encodeURIComponent(address);
            }

            // Перенаправляємо користувача на сторінку з параметром адреси
            window.location.href = url;
        });

        $('#search-input').on('keyup', function (event) {
            // Код клавіші Enter
            var ENTER_KEYCODE = 13;

            // Якщо натиснута клавіша Enter
            if (event.keyCode === ENTER_KEYCODE) {
                // Отримуємо текст з інпуту
                var address = $(this).val();

                var startDate = $('input[name="daterange"]').data('daterangepicker').startDate.format('DD-MM-YYYY HH:mm');
                var endDate = $('input[name="daterange"]').data('daterangepicker').endDate.format('DD-MM-YYYY HH:mm');

                var url = '/parkings?start_date=' + encodeURIComponent(startDate) + '&end_date=' + encodeURIComponent(endDate);
                if (address.trim() !== '') {
                    url += '&address=' + encodeURIComponent(address);
                }

                // Перенаправляємо користувача на сторінку з параметром адреси
                window.location.href = url;
            }
        });
    });

</script>
</body>
</html>

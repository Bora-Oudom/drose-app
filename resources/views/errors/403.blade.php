<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{-- Fontawsome --}}
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css' rel='stylesheet'
        type='text/css' />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div class="exception-error">
    </div>
    <div class="box">
        <div class="box__ghost">
            <div class="symbol"></div>
            <div class="symbol"></div>
            <div class="symbol"></div>
            <div class="symbol"></div>
            <div class="symbol"></div>
            <div class="symbol"></div>

            <div class="box__ghost-container">
                <div class="box__ghost-eyes">
                    <div class="box__eye-left"></div>
                    <div class="box__eye-right"></div>
                </div>
                <div class="box__ghost-bottom">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
            <div class="box__ghost-shadow"></div>
        </div>

        <div class="box__description">
            <div class="box__description-container">
                <div class="box__description-title">403</div>
                <div class="box__description-text">You have no permission to access these page</div>
            </div>

            <a href="{{ route('home') }}" class="box__button">Go back</a>

        </div>

    </div>
    <script type="module">
        //based on https://dribbble.com/shots/3913847-404-page

        $(document).mousemove(function(event) {
            let pageX = $(document).width();
            let pageY = $(document).height();

            //verticalAxis
            let mouseY = event.pageY;
            let yAxis = ($(document).height() / 2 - mouseY) / $(document).height() * 300;
            //horizontalAxis
            let mouseX = event.pageX / -$(document).width();
            let xAxis = (mouseX * 100) - 100;

            //verticalAxis
            mouseY = event.pageY;
            yAxis = (pageY / 2 - mouseY) / pageY * 300;
            //horizontalAxis
            mouseX = event.pageX / -pageX;
            xAxis = -mouseX * 100 - 100;

            $('.box__ghost-eyes').css({
                'transform': 'translate(' + xAxis + '%,-' + yAxis + '%)'
            });

            //console.log('X: ' + xAxis);

        });
        
    </script>
</body>

</html>

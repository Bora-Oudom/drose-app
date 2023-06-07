<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DBlog') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{-- Fontawsome --}}
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css' rel='stylesheet'
        type='text/css' />

    {{-- Dropzone --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css"> --}}

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/sass/app.scss', 'resources/js/app.js'])

    @stack('header-scripts')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'DBlog') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            {{-- @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif --}}
                        @else
                            @can('edit-user', 'create-user')
                                <li><a class="nav-link" href="{{ route('users.index') }}">Manage Users</a></li>
                                <li><a class="nav-link" href="{{ route('register') }}">Create User</a></li>
                            @endcan

                            <li><a class="nav-link" href="{{ route('blogs.create') }}">Create Blogs</a></li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('users.show', auth()->id()) }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('user-show').submit();">
                                        {{ __('Profile') }}
                                    </a>

                                    <form id="user-show" action="{{ route('users.show', auth()->id()) }}" method="GET"
                                        class="d-none">
                                        @csrf
                                    </form>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Create User') }}</a>
                                </li>
                            @endif --}}
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="background">
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        @yield('content')
    </div>
    @stack('footer-scripts')
    <script type="module">
        $(document).ready(function() {
            $('.hide').hide();
            // Add a click event listener to the button
            $('.delete').click(function(e) {
                e.preventDefault();
                // console.log($(this).parent().find('input[name=blog_id]').val());
                // console.log($(this).attr("data-id"));
                var id=$(this).attr("data-id");
                // Prevent the default form submission behavior
                // Ask the user for confirmation
                const result = confirm('Are you sure?');
                // If the user confirms
                if (result) {
                    // Submit the delete form
                    $('#delete-form-' +id).submit();
                }
            });
            $('.unhide').click(function (e) { 
                e.preventDefault();
                $(this).hide();
                $(this).siblings('.hide').show();
                $(this).siblings('#password').attr('type', 'text');
                $(this).siblings('#password-confirm').attr('type', 'text');
            });
            $('.hide').click(function (e) { 
                e.preventDefault();
                $(this).hide();
                $(this).siblings('.unhide').show();
                $(this).siblings('#password').attr('type', 'password');
                $(this).siblings('#password-confirm').attr('type', 'password');

            });
        });
        
    </script>
    <script type="module">
        function readFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                var htmlPreview =
                    '<img width="150" src="' + e.target.result + '" />'
                    // '<p>' + input.files[0].name + '</p>';
                var wrapperZone = $(input).parent();
                var previewZone = $(input).parent().parent().find('.preview-zone');
                var desc = $(input).siblings('.dropzone-desc');
                var boxZone = $(input).siblings('.box-body');  //$(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');

                wrapperZone.removeClass('dragover');
                // previewZone.removeClass('hidden');
                boxZone.empty();
                desc.addClass('hidden');
                boxZone.append(htmlPreview);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".dropzone").change(function() {
            readFile(this);
        });

        $('.dropzone-wrapper').on('dragover', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).addClass('dragover');
        });

        $('.dropzone-wrapper').on('dragleave', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).removeClass('dragover');
        });

        $('.remove-preview').on('click', function() {
        var boxZone = $(this).parents('.preview-zone').find('.box-body');
        var previewZone = $(this).parents('.preview-zone');
        var dropzone = $(this).parents('.form-group').find('.dropzone');
        boxZone.empty();
        previewZone.addClass('hidden');
        reset(dropzone);
        });
    </script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"></script> --}}
</body>

</html>

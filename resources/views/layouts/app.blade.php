<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    @include('layouts.partials.css')
    @yield('css')
</head>

<body class="font-poppins">

    @if (empty(request()->segment(2)) || request()->segment(2) == 'home')
        @include('layouts.partials.main-header')
    @endif
    <main class="relative bg-cover bg-no-repeat bg-center"
        style="background-image: url('@if(!empty(session('page_background_image'))){{ asset('uploads/' . session('page_background_image')) }}@else{{ asset('images/default-page-bg.png') }}@endif')">
        @yield('content')
    </main>
    @include('layouts.partials.footer')
    <script>
        base_path = "{{ url('/') }}";
    </script>
    @include('layouts.partials.javascript')
    <script>
        @if (!empty(session('status')))
            @if (session('status.success') == 1)
                swal.fire("", "{{ session('status.msg') }}", "success");
            @elseif(session('status.success') == '0')
                swal.fire("@lang('lang.error')!", "{{ session('status.msg') }}", "error");
            @endif
        @endif
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function(jqXHR, settings) {
                if (settings.url.indexOf('http') === -1) {
                    settings.url = base_path + settings.url;
                }
            },
        });
    </script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://unpkg.com/flowbite@1.3.4/dist/flowbite.js"></script>
    <script src="https://unpkg.com/flowbite@1.3.4/dist/datepicker.js"></script>
    @yield('javascript')
</body>

</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased">
    @if (session('message'))
        <div class="success-message">
            {{ session('message') }}
            <span class="cancel-button">&times;</span>
        </div>
    @endif
    {{ $slot }}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.cancel-button').click(function() {
            $(this).parent('.success-message').hide();
        });
    });
    </script>
</body>
</html>

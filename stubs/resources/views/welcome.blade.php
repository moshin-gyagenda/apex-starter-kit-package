{{-- 
    Apex Starter Kit - Welcome Page
    This page redirects to the Apex Starter Kit frontend.
    The default welcome page has been replaced by Apex Starter Kit.
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="0; url={{ url('/') }}">
    <title>{{ config('app.name', 'Apex Starter Kit') }}</title>
    <script>
        // Immediate redirect to frontend
        window.location.href = '{{ url('/') }}';
    </script>
</head>
<body>
    <div style="display: flex; align-items: center; justify-content: center; min-height: 100vh; font-family: system-ui, sans-serif;">
        <div style="text-align: center;">
            <h1>Welcome to Apex Starter Kit</h1>
            <p>Redirecting to frontend...</p>
            <p><a href="{{ url('/') }}">Click here if you are not redirected</a></p>
        </div>
    </div>
</body>
</html>

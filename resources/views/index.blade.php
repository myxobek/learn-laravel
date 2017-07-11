<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="stylesheet" href="{{ \Illuminate\Support\Facades\URL::asset('css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ \Illuminate\Support\Facades\URL::asset('css/bootstrap-table.css') }}">

        <script type="text/javascript" src="{{ \Illuminate\Support\Facades\URL::asset('js/jquery-1.9.1.js') }}"></script>
        <script type="text/javascript" src="{{ \Illuminate\Support\Facades\URL::asset('js/bootstrap.js') }}"></script>
        <script type="text/javascript" src="{{ \Illuminate\Support\Facades\URL::asset('js/bootstrap-table.js') }}"></script>
        <script type="text/javascript" src="{{ \Illuminate\Support\Facades\URL::asset('js/index.js') }}"></script>
    </head>
    <body>
        <div id="table"></div>
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
    </head>

    <body>
        <div id="app">
            <router-link to="/customers">Customer</router-link>
            <router-link to="/tools">Tools</router-link>

            <router-view></router-view>
            
        </div>
        <script src="/js/app.js"></script>
    </body>
</html>

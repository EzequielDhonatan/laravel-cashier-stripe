<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Home - {{ config( 'app.name' ) }}</title>

        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset( 'images/favicon/favicon-32x32.png' ) }}" />
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset( 'images/favicon/favicon-96x96.png' ) }}" />
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset( 'images/favicon/favicon-16x16.png' ) }}" />

        <link rel="icon" href="{{ asset( 'images/favicon.ico' ) }}">

        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Karla:wght@300;400;500;700&display=swap" />
        <link rel="stylesheet" href="{{ asset( 'css/site.css' ) }}">

    </head>

    <body>

        <div id="app">

            @include( 'site._partials.header' )

            <main class="main main--footerFixed bg-gray-100">

                @include( 'site._partials.features-header' )

                @include( 'site._partials.what-is' )

                @include( 'site._partials.features' )

                @include( 'site._partials.plans', [
                    'plans' => $plans
                ])

                @include( 'site._partials.contact' )

            </main>

            @include( 'site._partials.footer' )

        </div> <!-- #app -->

        <script src="{{ asset( 'js/app.js' ) }}"></script>

    </body>

</html>

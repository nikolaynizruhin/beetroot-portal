<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Beetroot Family Portal</title>

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/ico" href="{{ asset('favicon.ico') }}"/>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,200,300,400,500,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #A51140;
                font-family: 'Roboto', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .content {
                text-align: center;
                max-width: 768px;
                padding: 0 20px;
            }

            .title {
                font-size: 56px;
                font-weight: 500;
            }

            .subtitle {
                font-size: 26px;
                font-weight: 300;
            }

            a {
                color: #A51140;
                font-size: 24px;
            }

            .background-image {
                background-image: url("{{ asset('images/welcome.svg') }}");
                height: 100%;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }

            @media (max-width: 768px) {
                .title {
                    font-size: 32px;
                }

                .subtitle {
                    font-size: 22px;
                }

                a {
                    font-size: 20px;
                }
            }
        </style>

        <!-- Scripts -->
        <script defer src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
    </head>
    <body class="background-image">
        <div class="flex-center full-height">

            <div class="content">
                <div class="title">
                    Look who's here!
                </div>

                <div class="subtitle">
                    <p>
                        You're about to dive into a Beetroot family portal,
                        where all the information about your fellow beets,
                        teams and offices is stored.
                        Does it sound exciting?
                    </p>

                    <a href="@auth {{ route('dashboard') }} @else {{ @route('login') }} @endauth">
                        Let's roll!
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>

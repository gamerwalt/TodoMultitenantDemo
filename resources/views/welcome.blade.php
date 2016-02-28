<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Laravel 5 Multitenant Todo Application</div>
                <div>
                    <a href="{{ route('session.register') }}" class="btn btn-primary"><strong>Register Here</strong></a>
                    <a href="{{ route('session.signin') }}" class="btn btn-primary"><strong>Sign In</strong></a>
                </div>
                <div class="row">
                    @if(Session::has('message'))
                        <div class="alert alert-{!! Session::get('message_type') !!}">
                            {!! Session::get('message') !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>

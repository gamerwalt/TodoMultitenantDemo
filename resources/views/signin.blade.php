<!DOCTYPE html>
<html>
    <head>
        <title>Multitenant Sample</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <style>
            .required{
                font-weight: bold;
                color: red;
                font-size: 1.5em;
            }
        </style>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="alert alert-info">Laravel 5 Multitenant Todo Application</div>
                {{ Form::open(array('route' => 'session.signin')) }}
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <h3><span class="label label-primary">Sign In!</span></h3>
                        </div>
                        <div class="col-md-6 col-md-offset-3">
                            <div class="row">
                                <!-- email Form Input -->
                                <div class="form-group col-sm-12 col-md-6">
                                    <span class="required">*</span>
                                    {!! Form::label('email', 'Email : ') !!}
                                    {!! Form::text('email', null, ['placeholder' => 'Email ', 'class' => 'form-control']) !!}
                                </div>
                                <!-- password Form Input -->
                                <div class="form-group col-sm-12 col-md-6">
                                    <span class="required">*</span>
                                    {!! Form::label('password', 'Password : ') !!}
                                    {!! Form::password('password', ['placeholder' => 'Password ', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12 col-md-12">
                                    <div class="pull-right">
                                        {!! link_to_route('home', 'Back', null, array('class' => 'btn btn-link')) !!}
                                        {!! Form::submit('Sign In', array('class' => 'btn btn-primary btn-flat')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if(! $errors->isEmpty())
                                    <div class="col-sm-12 col-md-12 alert alert-danger">
                                        @foreach($errors->all() as $error)
                                            <li>{!! $error !!}</li>
                                        @endforeach
                                    </div>
                                    <?php $errors = null; ?>
                                    <script>
                                        $('form:first *:input[type!=hidden]:first').focus();
                                    </script>
                                @endif
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
                {{ Form::close() }}
            </div>
        </div>
    </body>
</html>

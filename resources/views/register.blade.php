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
                {{ Form::open(array('route' => 'session.register')) }}
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <h3><span class="label label-primary">Sign Up!</span></h3>
                        </div>
                        <div class="col-md-6 col-md-offset-3">
                            <div class="row">
                                <!-- email Form Input -->
                                <div class="form-group col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <span class="required">*</span>
                                    {!! Form::label('email', 'Email : ') !!}
                                    {!! Form::text('email', null, ['placeholder' => 'Email ', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="row">
                                <!-- password Form Input -->
                                <div class="form-group col-sm-12 col-md-6">
                                    <span class="required">*</span>
                                    {!! Form::label('password', 'Password : ') !!}
                                    {!! Form::password('password', ['placeholder' => 'Password ', 'class' => 'form-control']) !!}
                                </div>
                                <!-- password_confirmation Form Input -->
                                <div class="form-group col-sm-12 col-md-6">
                                    <span class="required">*</span>
                                    {!! Form::label('password_confirmation', 'Confirm Password : ') !!}
                                    {!! Form::password('password_confirmation', ['placeholder' => 'Confirm Password ', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="row">
                                <!-- name Form Input -->
                                <div class="form-group col-sm-12 col-xs-12 col-md-6 col-lg-6">
                                    <span class="required">*</span>
                                    {!! Form::label('name', 'Name : ') !!}
                                    {!! Form::text('name', null, ['placeholder' => 'Name ', 'class' => 'form-control']) !!}
                                </div>
                                <!-- company_name Form Input -->
                                <div class="form-group col-sm-12 col-xs-12 col-md-6 col-lg-6">
                                    <span class="required">*</span>
                                    {!! Form::label('company_name', 'Company Name : ') !!}
                                    {!! Form::text('company_name', null, ['placeholder' => 'Company Name ', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12 col-md-12">
                                    <div class="pull-right">
                                        {!! link_to_route('home', 'Back', null, array('class' => 'btn btn-link')) !!}
                                        {!! Form::submit('Register', array('class' => 'btn btn-primary btn-flat')) !!}
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
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </body>
</html>

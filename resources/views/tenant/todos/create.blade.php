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
                <div class="alert alert-info">Dashboard<div class="pull-right">{!! link_to_route('tenant.signout', 'Sign Out', null, array('class' => 'btn btn-danger')) !!}</div></div>
                <div style="text-align: center;"><strong>{!! session('company_name') !!}</strong></div>
                <hr/>
                <div><h3><span class="label label-primary">Create New Todo</span></h3></div>
                <div class="row jumbotron">
                    <div class="col-sm-12 col-md-12">
                        {{ Form::open(array('route' => 'todo.create')) }}
                            <!-- todo Form Input -->
                            <div class="form-group col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                <span class="required">*</span>
                                {!! Form::label('todo', 'Todo : ') !!}
                                {!! Form::text('todo', null, ['placeholder' => 'Todo ', 'class' => 'form-control']) !!}
                            </div>

                            <div class="form-group col-sm-12 col-md-12">
                                <div class="pull-right">
                                    {!! link_to_route('todos', 'Cancel', null, array('class' => 'btn btn-link')) !!}
                                    {!! Form::submit('Create Todo', array('class' => 'btn btn-success')) !!}
                                </div>
                            </div>
                        {{ Form::close() }}
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
    </body>
</html>

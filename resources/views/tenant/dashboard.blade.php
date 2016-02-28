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

                <div class="row">
                    <div class="col-sm-6 col-md-6">
                        {!! link_to_route('todo.create', 'Create Todo', null, array('class' => 'btn btn-primary')) !!}
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="jumbotron">
                        @if(count($todos) > 0)
                            <ul>
                            @foreach($todos as $todo)
                                <li>{!! $todo->body !!} - <span class="label label-primary">@if($todo->completed) Yes @else No @endif</span> <span>{!! link_to_route('todo.toggle', 'Toggle', $todo->body, array('class' => 'btn btn-link')) !!}</span></li>
                            @endforeach
                            </ul>
                        @else
                            No todos today!!!
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

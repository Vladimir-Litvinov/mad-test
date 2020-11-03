@extends('layouts.app')
<?php  /** @var \Illuminate\Support\ViewErrorBag $errors */  ?>
@section('content')
    <div class="panel-heading container-fluid">
        <div class="form-group">
            <center>
                <div class="centered-child col-md-9 col-sm-7 col-xs-6"><b>id: {{$appointment->id}}</b></div>
            </center>
        </div>
    </div>

    <div class="panel-body">
        {!! Form::model($appointment, ['route' => ['change-status', $appointment->id], 'method' => 'PUT']) !!}

        @include('appointment._formStatus')

        <div class="form-group">
            {!! Form::button('Edit', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
            <a class="btn btn-info btn-xs col-md-1 col-sm-2 col-xs-2" href="{{route('appointment.index')}}">
                <i class="fa fa-backward" aria-hidden="true"></i> Back
            </a>
        </div>
        {!! Form::close() !!}
    </div>


@endsection


@extends('layouts.app')
<?php  /** @var \Illuminate\Support\ViewErrorBag $errors */  ?>
@section('content')
    <div class="panel-heading container-fluid">
        <div class="form-group">
            <center>
                <div class="centered-child col-md-9 col-sm-7 col-xs-6"><b>id: {{$package->id}}</b></div>
            </center>

        </div>
    </div>

    <div class="panel-body">
        {!! Form::model($package, ['route' => ['package.update', $package->id], 'method' => 'PUT']) !!}


@include('package._form')


        <div class="form-group">
            {!! Form::button('Edit', ['type' => 'submit','class' => 'btn btn-primary']) !!}
            <a class="btn btn-info btn-xs col-md-1 col-sm-2 col-xs-2" href="{{route('package.index')}}">
                <i class="fa fa-backward" aria-hidden="true"></i> Back
            </a>
        </div>

        {!! Form::close() !!}

    </div>




    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{--@include('layouts.errors')--}}

@endsection
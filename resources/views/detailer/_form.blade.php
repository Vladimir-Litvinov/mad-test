<div class="form-group">


    {!!Form::label('name', 'Name') !!}
    {!!Form::text('name', null, ['class' => 'form-control' , 'required']) !!}

    {!!Form::label('email', 'Email') !!}
    {!!Form::email('email', null, ['class' => 'form-control','required']) !!}

    {!!Form::label('phone', 'Phone') !!}
    {!!Form::number('phone', null, ['class' => 'form-control','required']) !!}

    <br>
    {!!Form::label('image', 'Avatar') !!}
    {!!Form::file('image', null, ['class' => 'form-control']) !!}



</div>

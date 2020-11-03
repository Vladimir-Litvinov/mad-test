<div class="form-group">

    {!!Form::label('title', 'Title') !!}
    {!!Form::text('title', null, ['class' => 'form-control' , 'required']) !!}

    {!!Form::label('price', 'Price') !!}
    {!!Form::number('price', null, ['class' => 'form-control','required']) !!}

</div>

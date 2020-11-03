<div class="form-group">
    {!! Form::label('status_id','Status') !!}
    {!! Form::select('status_id', \App\Models\Status::getStatusList(),
    isset($status) ? $status->status_id : null,
     ['class' => 'form-control']) !!}
</div>


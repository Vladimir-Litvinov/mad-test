@extends('layouts.app') @section('content')

    <div class="panel panel-default" style="text-align: center; margin: auto; width: 90%">
        <div class="panel-heading">Appointments</div>
        <p></p>
        {{--        {{ link_to_route('appointment.create','Create',null, ['class' => 'btn-info btn-xs']) }}--}}
        <p></p>

        <div class="panel-body">
            <table class="table table-bordered table-responsive table-striped">
                <tr>
                    <th width="1%">id</th>
                    <th width="3%">Address</th>
                    <th width="2%">Asap</th>
                    <th width="2%">Specific Time</th>
                    <th width="2%">comment</th>
                    <th width="2%">Price</th>
                    <th width="2%">Package</th>
                    <th width="2%">Status for client</th>
                    <th width="2%">Action</th>
                </tr>
                <tr>
                    <td colspan="13" class="light-green-background no-padding">
                        <div class="row centered-child">
                            <div class="col-md-20">
                            </div>
                        </div>
                    </td>
                </tr>
                @foreach($appointment as $model)
                    <td>{{$model->id}}</td>
                    <td>{{$model->country}}<br/>
                        {{$model->city}} <br/>
                        {{$model->street}}<br/>
                        {{$model->house}}<br/>
                        {{$model->zip_code ?? null}}
                    </td>
                    <td>{{$model->asap ?? 'look a specific time'}}</td>
                    <td>{{$model->specific_time ?? 'look a asap'}}</td>
                    <td>{{$model->comment}}</td>
                    <td>{{$model->price}}</td>
                    <td>{{$model->package->title}}</td>
                    <td>{{$model->status->title}}</td>
                @endforeach

            </table>
        </div>
    </div>
@endsection

@extends('layouts.app') @section('content')



    <div class="panel panel-default" style="text-align: center; margin: auto; width: 90% ">

        <div class="panel-heading">Appointment: {{$appointment->id}}</div>
        <p></p>
        <p></p>
        <div class="panel-body">

            <center>Main data</center>
            <table class="table table-bordered table-responsive table-striped">
                <tr>
                    <th width="1%">Address</th>
                    <th width="1%">Asap</th>
                    <th width="1%">Specific Time</th>
                    <th width="1%">comment</th>
                    <th width="1%">Price</th>
                    <th width="1%">Package</th>
                </tr>
                <tr>
                    <td colspan="13" class="light-green-background no-padding">
                        <div class="row centered-child">
                            <div class="col-md-20">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>{{$appointment->country}}<br/>
                        {{$appointment->city}} <br/>
                        {{$appointment->street}}<br/>
                        {{$appointment->house}}<br/>
                        {{$appointment->zip_code ?? null}}
                    </td>
                    <td>{{$appointment->asap ?? 'look a specific time'}}</td>
                    <td>{{$appointment->specific_time ?? 'look a asap'}}</td>
                    <td>{{$appointment->comment}}</td>
                    <td>{{$appointment->price}}</td>
                    <td>{{$appointment->package->title}}</td>
                </tr>

            </table>
            <center>Other data</center>
            <table class="table table-bordered table-responsive table-striped">
                <tr>
                    <th width="1%">Client</th>
                    <th width="1%">Detailer</th>
                    <th width="1%">Status for client</th>
                    <th width="1%">Status for detailer</th>
                </tr>
                <tr>
                    <td colspan="13" class="light-green-background no-padding">
                        <div class="row centered-child">
                            <div class="col-md-20">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        {{$appointment->client->id}}<br/>
                        {{$appointment->client->name}}<br/>
                        {{$appointment->client->phone}}<br/>
                        {{$appointment->client->email}}<br/>
                    </td>
                    <td>
                        {{$appointment->detailer->id ?? null}}<br/>
                        {{$appointment->detailer->name ?? null}}<br/>
                        {{$appointment->detailer->phone ?? null}}<br/>
                        {{$appointment->detailer->email ?? null}}<br/>
                    </td>
                    <td>{{$appointment->status->title}}</td>
                    <td>{{$appointment->statusDetailer->title ?? null}}</td>
                </tr>
            </table>
            <div style="text-align: right;">

                {{Form::open(['style' => 'display:flex;float:right', 'route' => ['appointment.destroy', $appointment->id], 'method' => 'DELETE'])}}
{{--                {{ link_to_route('getDetailer', 'Detailer', [$appointment->id], ['class' => 'btn btn-dark btn-xs']) }}--}}
                {{ link_to_route('edit-status', 'Status', [$appointment->id], ['class' => 'btn btn-secondary btn-xs']) }}
                {{ link_to_route('appointment.edit', 'Edit', [$appointment->id], ['class' => 'btn btn-success btn-xs']) }}
                {{Form::button('Delete', ['class' => 'btn btn-danger btn-xs', 'type' => 'submit'])}} {{Form::close()}}
                {{Form::close()}}
            </div>

        </div>
    </div>
@endsection

@extends('layouts.app') @section('content')
    {{--<div class="container">--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-8 col-md-offset-2">--}}



    <div class="panel panel-default" style="text-align: center; margin: auto; width: 90% ">

        <div class="panel-heading">Clients list</div>

        <p></p>
        <div class="panel-body">
            <table class="table table-bordered table-responsive table-striped">
                <tr>
                    <th width="1%">id</th>
                    <th width="1%">Phone</th>
                    <th width="1%">E-mail</th>
                    <th width="1%">Name</th>
                    <th width="1%">Avatar</th>
                    <th width="1%">Action</th>


                </tr>
                <tr>
                    <td colspan="13" class="light-green-background no-padding" title="Create new template">
                        <div class="row centered-child">
                            <div class="col-md-20">
                            </div>
                        </div>
                    </td>
                </tr>
                @foreach ($users as $model)
                    <tr>

                        <td>{{$model->id}}</td>
                        <td>{{$model->phone}}</td>
                        <td>{{$model->email}}</td>
                        <td>{{$model->name}}</td>
                        <td>
                            <img src="{{$model->image}}" style="height: 100px;width:100px" ;>
                        </td>
                        <td>
                            {{ link_to_route('appointments', 'Appointments', [$model->id], ['class' => 'btn btn-primary btn-xs']) }}
                        </td>

                    </tr>
                @endforeach

            </table>
            {{$users->links()}}
        </div>
    </div>
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
@endsection

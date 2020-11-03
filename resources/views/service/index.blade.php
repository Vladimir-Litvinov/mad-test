@extends('layouts.app') @section('content')



    <div class="panel panel-default" style="text-align: center; margin: auto; width: 90% ">

        <div class="panel-heading">Services</div>
        <p></p>
        {{ link_to_route('service.create', 'Create', null, ['class' => 'btn btn-info btn-xs']) }}
        <p></p>
        <div class="panel-body">
            <table class="table table-bordered table-responsive table-striped">
                <tr>
                    <th width="1%">Title</th>
                    <th width="1%">Price</th>
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
                @foreach($services as $model)
                <tr>
                    <td>{{$model->title}}</td>
                    <td>{{$model->price}}</td>
                    <td style="text-align: left">
                        {{Form::open(['class' => 'confirm-delete', 'route' => ['service.destroy', $model->id], 'method' => 'DELETE'])}}
                        {{ link_to_route('service.edit', 'Edit', [$model->id], ['class' => 'btn btn-success btn-xs']) }}
                        {{Form::button('Delete', ['class' => 'btn btn-danger btn-xs', 'type' => 'submit'])}} {{Form::close()}}
                        {{Form::close()}}
                    </td>
                </tr>
                    @endforeach

            </table>
        </div>
        {{$services->links()}}
    </div>

@endsection

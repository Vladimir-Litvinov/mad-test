@extends('layouts.app') @section('content')



    <div class="panel panel-default" style="text-align: center; margin: auto; width: 90% ">

        <div class="panel-heading">Packages</div>
        <p></p>
        {{ link_to_route('package.create', 'Create', null, ['class' => 'btn btn-info btn-xs']) }}
        <p></p>
        <div class="panel-body">
            <table class="table table-bordered table-responsive table-striped">
                <tr>
                    <th width="1%">id</th>
                    <th width="1%">Title</th>
                    <th width="1%">Price</th>
                    <th width="1%">if Custom(name, email, phone)</th>
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
                @foreach($packages as $model)
                <tr>
                    <td>{{$model->id}}</td>
                    <td>{{$model->title}}</td>
                    <td>{{$model->price}}</td>
                    <td>{{$model->user->name ?? null}}<br/> {{$model->user->email ?? null}}<br/> {{$model->user->phone ?? null}}</td>
                    <td style="text-align: left">
                        {{Form::open(['class' => 'confirm-delete', 'route' => ['package.destroy', $model->id], 'method' => 'DELETE'])}}
                        {{ link_to_route('package.edit', 'Edit', [$model->id], ['class' => 'btn btn-success btn-xs']) }}
                        {{Form::button('Delete', ['class' => 'btn btn-danger btn-xs', 'type' => 'submit'])}} {{Form::close()}}
                        {{Form::close()}}
                    </td>
                </tr>
                    @endforeach

            </table>
            {{$packages->links()}}
        </div>
    </div>
@endsection

@extends('layouts.app') @section('content')
    {{--<div class="container">--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-8 col-md-offset-2">--}}



    <div class="panel panel-default" style="text-align: center; margin: auto; width: 90% ">

        <div class="panel-heading">Support</div>

        <p></p>
        <div class="panel-body">
            <table class="table table-bordered table-responsive table-striped">
                <tr>
                    <th width="1%">Phone</th>
                    <th width="1%">E-mail</th>
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
                    <tr>

                        <td>{{$support->phone}}</td>
                        <td>{{$support->email}}</td>

                        <td style="text-align: left">
                            {{ link_to_route('support.edit', 'Edit', [$support->id], ['class' => 'btn btn-success btn-xs']) }}
                        </td>
                    </tr>

            </table>
        </div>
    </div>
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
@endsection

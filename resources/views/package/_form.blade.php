<div class="form-group">

    {!!Form::label('title', 'Title') !!}
    {!!Form::text('title', null, ['class' => 'form-control' , 'required']) !!}


    {!!Form::label('category_id', 'Category') !!}
    {!!Form::select('category_id', \App\Models\Category::getCategoryList(),
     isset($status) ? $status->category_id : null,

     ['class' => 'form-control']) !!}


    {!!Form::label('service_id', 'Services') !!}
    <br>

    @php
        $services = \App\Models\Service::get();
    @endphp
    @foreach($services as $service)


        @php
            $services_id = \App\Models\PackageService::where('package_id',$package->id)->pluck('service_id');

            $services_not_id = \App\Models\Service::whereNotIn('id',$services_id)->pluck('id');

        @endphp

        @foreach($services_id as $value)
            @if($value == $service->id)
                {!!Form::checkbox('service_id[]',$service->id,true) !!} {{$service->title}} - {{$service->price}}$<br>
            @endif
        @endforeach

        @foreach($services_not_id as $item)
            @if($item == $service->id)
                {!!Form::checkbox('service_id[]',$service->id) !!} {{$service->title}} - {{$service->price}}$<br>
            @endif
        @endforeach
    @endforeach

</div>

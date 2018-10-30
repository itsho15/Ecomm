@extends('admin.index')
@section('content')

 @push('js')
 <script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyBwxuW2cdXbL38w9dcPOXfGLmi1J7AVVB8'></script>
 <script type="text/javascript" src='{{ url('design/adminlte/dist/js/locationpicker.jquery.js') }}'></script>
<?php
$lat = !empty($shiping->lat)?$shiping->lat:'30.034024628931657';
$lng = !empty($shiping->lng)?$shiping->lng:'31.24238681793213';

?>
 <script>
  $('#us1').locationpicker({
      location: {
          latitude: {{ $lat }},
          longitude:{{ $lng }}
      },
      radius: 300,
      markerIcon: '{{ url('design/adminlte/dist/img/map-marker-2-xl.png') }}',
      inputBinding: {
        latitudeInput: $('#lat'),
        longitudeInput: $('#lng'),
       // radiusInput: $('#us2-radius'),
        //locationNameInput: $('#address')
      }

  });
 </script>
 @endpush

<div class="box">
  <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    {!! Form::open(['url'=>aurl('shiping/'.$shiping->id),'method'=>'put','files'=>true ]) !!}
      <input type="hidden" value="{{ $lat }}" id="lat" name="lat">
    <input type="hidden" value="{{ $lng }}" id="lng" name="lng">
   <div class="form-group">
        {!! Form::label('name_ar',trans('admin.name_ar')) !!}
        {!! Form::text('name_ar',$shiping->name_ar,['class'=>'form-control']) !!}
     </div>

     <div class="form-group">
        {!! Form::label('name_en',trans('admin.name_en')) !!}
        {!! Form::text('name_en',$shiping->name_en,['class'=>'form-control']) !!}
     </div>



     <div class="form-group">
        {!! Form::label('user_id',trans('admin.owner_id')) !!}
        {!! Form::select('user_id',\App\User::where('level','company')->pluck('name','id'),$shiping->user_id,['class'=>'form-control']) !!}
     </div>

     <div class="form-group">
       <div id="us1" style="width: 100%; height: 400px;"></div>
     </div>


     <div class="form-group">
        {!! Form::label('icon',trans('admin.trade_icon')) !!}
        {!! Form::file('icon',['class'=>'form-control']) !!}

      @if(!empty($shiping->icon))
       <img src="{{ Storage::url($shiping->icon) }}" style="width:50px;height: 50px;" />
      @endif

     </div>


     {!! Form::submit(trans('admin.save'),['class'=>'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->



@endsection
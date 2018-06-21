@extends('layouts.app')

@section('content')
  <div class="container">
    @if(session('success'))
      <div class="alert alert-success text-center mt-4">
        {{session('success')}}
      </div>
    @endif

    @if(session('danger'))
      <div class="alert alert-danger text-center mt-4">
        {{session('danger')}}
      </div>
    @endif

    <form action="{{route('task.store')}}" method="post" onsubmit="return confirm('Please make sure information is correct and click ok to send');">
      {{-- @method('PUT') --}}

      @csrf
      <div class="form-group">
        <label for="deviceId" class="d-block">Device ID:</label>
        <input type="text" class="form-control-sm" id="deviceId" placeholder="Enter device ID" name="deviceId" required>
        @if ($errors->has('deviceId'))
          <div class="alert alert-danger mt-4 col-sm-4">
            <b>{{$errors->first('deviceId')}}</b>
          </div>
        @endif
      </div>

      <div class="form-group">
        <label class="d-block">Coordinates:</label>
        <input type="text" class="form-control-sm" id="coordinatesLat" placeholder="Enter latitude" name="latitude" required>
        <input type="text" class="form-control-sm" id="coordinatesLong" placeholder="Enter longitude" name="longitude" required>
        @if ($errors->has('latitude'))
          <div class="alert alert-danger mt-4 col-sm-4">
            <b>{{$errors->first('latitude')}}</b>
          </div>
        @endif
        <small id="coordinatesHelp" class="form-text text-muted">Example: <b>Lat</b>: 9.0200417, <b>Lng</b>: -79.5189333</small>
      </div>

      <div class="form-group">
        <label for="select" class="d-block">Please select one of the following options:</label>
        <select class="form-control col-sm-3" id="select" name="location">
          <option name="" value="" disabled selected>Select your option</option>
          <option name="home" value="home">1. Home</option>
          <option name="work" value="work">2. Work</option>
        </select>
        @if ($errors->has('location'))
          <div class="alert alert-danger mt-4 col-sm-4">
            <b>{{$errors->first('location')}}</b>
          </div>
        @endif
      </div>
      <button type="submit" class="btn btn-success" value="Send">Send</button>
    </form>
</div>
@endsection

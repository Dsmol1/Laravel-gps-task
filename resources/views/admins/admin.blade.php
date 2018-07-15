@extends('layouts.app')
@section('content')
  @auth
  <div class="container">
    <div class="row">
    <div class="col-sm-12 col-lg-6">
      {{-- <button type="submit" class="btn btn-success mb-3" value="Send">Add device</button> --}}
      <a href="{{route('home')}}" class="btn btn-success mb-3">Add device</a>
      {{-- Display devices --}}
      <table class="table">
          <thead>
            <tr>
              <th scope="col">Device ID</th>
              <th scope="col">Coordinates</th>
              <th scope="col">Type</th>
            </tr>
          </thead>

          @foreach ($devices as $device)
            @if (Auth()->id() === $device->user_id)
          <tbody>
            <tr>
              <td>{{$device->deviceId}}</td>
              <td><a href="https://www.google.lt/maps/search/{{$device->latitude}},+{{$device->longitude}}?sa=X&ved=0ahUKEwiki-G7seXbAhVGXSwKHce7ADMQ8gEIJzAA" target="_blank">{{$device->latitude}}, {{$device->longitude}}</a></td>

              <td>{{$device->type}}</td>
            </tr>
          </tbody>
            @endif
          @endforeach
      </table>

      <div class="">
        {{$devices->links()}}
      </div>
    </div>

    <div class="col-sm-12 col-lg-6">
      <h1>My Map</h1>
      <div id="map">
      </div>
    </div>
      <script type="text/javascript">

        function initMap(){
          var options = {
            zoom:4,
            center:{lat:54.6872, lng:25.2797}
          }
          var map = new google.maps.Map(document.getElementById('map'), options);

          @foreach ($devices as $device)
              @if (Auth()->id() === $device->user_id)

            addMarker({
              coords:{lat:{{$device->latitude}}, lng:{{$device->longitude}}},
              label: { color: '#fff', fontWeight: 'bold', fontSize: '9px', text: '{{$device->deviceId}}' },
              content:
              '<b>Dveice ID</b>: {{$device->deviceId}}<br>' +
              '<b>Type</b>: {{$device->type}}<br>' +
              '<b>Coordinates:</b><Br>Lat: {{$device->latitude}}, Lng: {{$device->longitude}}<br>' +
              '<a href="https://www.google.lt/maps/search/{{$device->latitude}},+{{$device->longitude}}?sa=X&ved=0ahUKEwiki-G7seXbAhVGXSwKHce7ADMQ8gEIJzAA" target="_blank"><B>Click to view on map</b><a>'
            });
            @endif
          @endforeach

          function addMarker(props){
            var marker = new google.maps.Marker({
              position:props.coords,
              map:map,
              label: props.label,
            });
            if (props.content) {
              var infoWindow = new google.maps.InfoWindow({
                content:props.content
              });

              marker.addListener('click', function(){
                infoWindow.open(map, marker);
                setTimeout(function () { infoWindow.close(); }, 5000);
              });
            }
          }
        }

      </script>

      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTprBbQBHpm5qweQkzatLeUWKLD2T5r5c&callback=initMap"
        async defer></script>
      @endauth

    @endsection

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  {{-- <script src="{{ asset('js/test.js') }}" defer></script> --}}
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <title>Email</title>
</head>
<body>
  <h1>Your device has been added to database successfully!</h1>
  <p>Device ID: <b>{{$task->deviceId}}</b></p>
  Coordinates:<br><br>
  Lat:<b>{{$task->latitude}}</b>, Lng: <b>{{$task->longitude}}</b>
  <br><br>
  <a href="https://www.google.lt/maps/search/{{$task->latitude}},+{{$task->longitude}}?sa=X&ved=0ahUKEwiki-G7seXbAhVGXSwKHce7ADMQ8gEIJzAA" target="_blank">Click to view on map.</a>
  <div id="emailOutput">

  </div>
</body>
<script type="text/javascript">
geocode();
function geocode(){
  let location = 'lat:{{$task->latitude}}, lng:{{$task->longitude}}';
  axios.get('https://maps.googleapis.com/maps/api/geocode/json',{
    params:{
      address:location,
      key:'AIzaSyBqgKZ40pxXAigIXetiNjSqAGd8xtHLCJQ',
    }
  })
  .then(function (response) {
    let formattedAddress = response.data.results[0].formatted_address;
    let emailOutput =
    `
    <h1>Your <b>work</b> device has been successfully added to database.</h1>
    <p>Device ID: {{$task->deviceId}}</p>
    <p>Address: ${formattedAddress}</p>
    `;

    document.getElementById('emailOutput').innerHTML = emailOutput;
  })
  .catch(function (error) {
    console.log(error);
  });
}
</script>
</html>

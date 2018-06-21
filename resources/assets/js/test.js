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

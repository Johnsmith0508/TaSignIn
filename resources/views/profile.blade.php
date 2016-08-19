@extends('layouts.app')

@section('content')
<div class="container">
  <div class="panel panel-default" style="width:300px; text-align:center">
    {{ HTML::image('img/default-user.jpeg', 'Profile Image', array('width' => 250, 'style' => 'margin:25px' )) }}
    <p class="panel-content">{{Auth::user()->name}}</p>
  </div>
  <div id="map"></div>
    <script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 8
        });
      }
    </script>
    <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyB1UpzdDPx7IK4fX6qqFC7KEfoydCJj5OY&callback=initMap"
    async defer></script>
</div>
@endsection
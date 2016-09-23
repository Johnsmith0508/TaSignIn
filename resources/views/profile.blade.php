@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-4">
      <div class="panel panel-default" style="text-align:center">
        {{ HTML::image('img/default-user.jpeg', 'Profile Image', array('width' => 250, 'style' => 'margin:25px' )) }}
        <p class="panel-content">{{Auth::user()->name}}</p>
        <p class="panel-content">Joined: {{substr(Auth::user()->created_at, 0,10)}}</p>
      </div>
    </div>
      <div class="col-lg-8">
        <div class="panel panel-default">
          <p class="panel-heading">Your Student Assistants</p>
          <table class="table table-hover">
            @include('students')
          </table>
        </div>
    <input type="button" class="button" id="toggleQR" value="Show QR code" onclick="$('#QR').toggle()">
    <div class="panel panel-default" id="QR" hidden>
      {{ HTML::image(Google2FA::getQRCodeGoogleUrl('Middleton%20TA',Auth::user()->email,Auth::user()->tfa_key)) }} {{Auth::user()->tfa_key}}
    </div>
      </div>
  </div>
</div>
@endsection
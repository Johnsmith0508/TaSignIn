@extends('layouts.app')
@section('content')
<div class="container">
  <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="infoModalLabel">STUDENTID Info</h4>
      </div>
      <div class="modal-body" id="infoBody">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
  </div>
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
          <table class="table table-hover" style="cursor:pointer">
            <thead><tr>
              <th>Student Number</th>
              <th>Last time left TA room</th>
              <th>Last time entered your room</th>
              <th>Verified?</th>
              </tr></thead>
            <?php
            $students = DB::table("studentTimeTable AS a")->select("a.studentID","timeOut","timeIn","unconfirmed")->join("students AS b","a.studentID","=","b.studentID")->where("teacher",Auth::user()->name)->get();
            $times = DB::table(DB::raw("(SELECT *, `timeIn` - `timeOut` AS `timeDiff` FROM `studentTimeTable`) AS a"))->select("studentID","timeOut","timeIn","timeDiff");
            function getTimesForStudent($studentID,$times)
            {
              $ret = "";
              foreach($times->get() as $i)
              {
                if($i->studentID == $studentID)
                {
                  $ret .= floor($i->timeDiff/60)." min  " . $i->timeDiff%60 . " sec  <strong>On " . date("Y-m-d",$i->timeOut) . "</strong><br />";
                }
              }
              return $ret;
            }
            
            function getAvgTime($studentID,$times)
            {
              $ret = $times->where("studentID","=",$studentID)->where("timeIn","!=","0")->avg("timeDiff");
              return floor($ret/60)." min  ". $ret%60 . " sec";
            }
            
            $maxTimeOut = array();
            foreach($students as $i)
            {
              if(!array_key_exists($i->studentID . "a",$maxTimeOut))
              {
                $maxTimeOut[$i->studentID . "a"] = $i->timeOut;
              }else{
                $maxTimeOut[$i->studentID  ."a"] = (($i->timeOut > $maxTimeOut[$i->studentID . "a"]) ? $i->timeOut : $maxTimeOut[$i->studentID . "a"]);
              }
            }
            
            $avgTime = $times->where("timeIn","!=","0")->avg("timeDiff");
            foreach($students as $i)
            {
              if($i->timeOut != $maxTimeOut[$i->studentID . "a"]) continue;
              echo "<tr class='studentRow'><td class='studentID'>" .
                $i->studentID.
                "</td><td>" .
                date("Y-m-d  H:ia",$i->timeOut) .
                "</td><td>" .
                (($i->timeIn) ? date("Y-m-d  H:ia",$i->timeIn) : "--") .
                "</td><td class='confSign'>" .
                "<input class='confirmedSignin' type='checkbox' " . ((!$i->unconfirmed && $i->timeIn != null)? "checked" :"") . "></input>" .
                "</td></tr>";
              echo "<tr class='studentInfoRow' hidden='hidden'><td colspan=4>" .
                "<strong>Average Time (all students)</strong> " . floor($avgTime/60)." min  " . $avgTime%60 . " sec" . "<br />" .
                "<strong>Average time (this student)</strong> " . getAvgTime($i->studentID,$times) .
                "<br />" .
                getTimesForStudent($i->studentID,$times).
                "</td></tr>";
              var_dump($times->get());
            }
            ?>
          </table>
        </div>
    <input type="button" class="button" id="toggleQR" value="Show QR code" onclick="$('#QR').toggle()">
    <div class="panel panel-default" id="QR" hidden>
      {{ HTML::image(Google2FA::getQRCodeGoogleUrl('Middleton%20TA',Auth::user()->email,Auth::user()->tfa_key)) }} {{Auth::user()->tfa_key}}
    </div>
      </div>
  </div>
</div>
<script>
  $(function(){
    $(".confirmedSignin").on("click",function(e){
      //console.log($(this).parent().parent().find(".studentID")[0].innerText);
      $.post("./profile",{toVerify:$(this).parent().parent().find(".studentID")[0].innerText});
    });
    $(".studentRow").on("click",function(e){
      if(e.target.attributes.class && e.target.attributes.class.nodeValue.includes("confirmedSignin"))return;
      //$("#infoModal").modal('toggle');
      //$("#infoModalLabel").text($(this).find(".studentID")[0].innerText + " info");
      $(this).next().toggle();
      var infoTable = '<table class="table table-hover" style="cursor:pointer">';
      
      $("#infoBody").html('<table class="table table-hover" style="cursor:pointer"></table>');
    });
  });
</script>
@endsection
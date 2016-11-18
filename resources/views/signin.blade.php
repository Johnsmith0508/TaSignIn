@extends('layouts.app')
@section('content')
<div class="container">
  <div class="panel panel-default">
                <div class="panel-heading">Sign In</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/signin') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('stuNbr') ? ' has-error' : '' }}">
                            <label for="stuNbr" class="col-md-4 control-label">Student Number</label>

                            <div class="col-md-6">
                              <input id="stuNbr" type="text" pattern="[0-9]*" inputmode="numeric" class="form-control" name="stuNbr" value="{{ old('stuNbr') }}" title="Please Enter a Valid Student Number"/>

                                @if ($errors->has('stuNbr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('stuNbr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tchr') ? ' has-error' : '' }}" id="tfaDiv">
                            <label for="tfa" class="col-md-4 control-label">Teacher's Unique Key</label>

                            <div class="col-md-6">
                              <input type="text" id="tfa" class="form-control" name="tfa" pattern="[0-9]*" inputmode="numeric" title="Please Enter a Valid Authentication Key"/>
                            </div>
                        </div>
                      <div class="form-group{{ $errors->has('tfa') ? ' has-error' : '' }}">
                            <label for="no_key" class="col-md-4 control-label">Teacher Does not have key</label>

                            <div class="col-md-1">
                              <input type="checkbox" id="no_key" class="form-control" name="no_key">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" id="loginBtn">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
</div>
<script>
  $(function(){
    $("#loginBtn").on("click",function(e){
        if(!$("#no_key").is(':checked') && $("#tfa").val() === "")
          {
            e.preventDefault();
            $("#tfaDiv").addClass("has-error");
            setTimeout(function(){
              $("#tfaDiv").removeClass("has-error");            
            },2500);
          }
      });
  });
</script>
@endsection

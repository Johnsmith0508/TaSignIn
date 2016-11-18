@extends('layouts.app')
@section('content')
<div class="container">
  <div class="panel panel-default">
                <div class="panel-heading">Sign Out</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/signout') }}">
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

                        <div class="form-group{{ $errors->has('tchr') ? ' has-error' : '' }}">
                            <label for="tchr" class="col-md-4 control-label">Teacher</label>

                            <div class="col-md-6">
                              <select id="tchr" class="form-control" name="tchr">
                                  <?php
                                $users = DB::table('users')->pluck('name');
                                foreach($users as $i)
                                {
                                  echo "<option value='".$i."'>".$i."</option>";
                                }
                                ?>
                                </select>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
</div>
@endsection
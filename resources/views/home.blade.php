@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                  @if(Auth::guest())
                    You are logged in!
                  @else
                    Please Log in first
                  @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

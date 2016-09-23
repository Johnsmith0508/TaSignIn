@extends('layouts.app')

@section('content')
<div id="container">
  Hi
  <forurm class="form-horizontal" role="form" method="POST" action="{{ url('/submitRoute') }}">
  <input type="text">
    <select name="Seclect A Thing">
      <option value="Test">Test</option>
      <option value="Test1">Test</option>
    </select>
  </forurm>
</div>
@endsection
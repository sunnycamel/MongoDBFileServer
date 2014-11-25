@extends('fileserver::layouts.layout')
@section('left-nav-bar')
  <ul class="nav nav-pills nav-stacked">
    <li class="navbar-header alert-success">File Server</li>
    <li><a href="/fileserver">List</a></li>
    <li class="active"><a href="/fileserver/create">New File</a></li>
  </ul>
@stop

@section('content')
  @if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
  @endif
  {{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => '/fileserver', 'files' => true)) }}

  <div class="form-group">
    {{ Form::label('file', 'File') }}
    {{ Form::file('file', array('class' => 'form-control')) }}
  </div> 

  <div class="form-group">
    {{ Form::label('filetype', 'File type') }}
    {{ Form::select('filetype', array('Image', "File"), Input::old('filetype'), array('class' => 'form-control')) }}
  </div> 

  <div class="form-group">
    {{ Form::label('keywords', 'Key Words') }}
    {{ Form::text('keywords', Input::old('keywords'), array('class' => 'form-control')) }}
  </div>
  
  <div class="form-group">
    {{ Form::label('description', 'Description') }}
    {{ Form::textarea('description', Input::old('description'), array('class' => 'form-control')) }}
  </div>

  {{ Form::submit('Submit', array('class' => 'btn btn-default')) }}

{{ Form::close() }}

@stop

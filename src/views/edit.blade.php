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

<table class="table table-striped table-bordered">
  <tr>
    <td>
      {{ Form::open(array('url' => '/fileserver/' . $file->_id, 'method' => 'PUT' )) }}

      <div class="form-group">
	{{ Form::label('filename', 'File Name:') }}
	{{ Form::label('filename', $file->filename) }}
      </div> 

      <div class="form-group">
	{{ Form::label('filetype', 'File type') }}
	{{ Form::select('filetype', array('Image', "File"), $file->filetype == 'image'? 0 : 1, array('class' => 'form-control')) }}
      </div> 

      <div class="form-group">
	{{ Form::label('keywords', 'Key Words') }}
	{{ Form::text('keywords', $file->keywords, array('class' => 'form-control')) }}
      </div>
  
      <div class="form-group">
	{{ Form::label('description', 'Description') }}
	{{ Form::textarea('description', $file->description, array('class' => 'form-control')) }}
      </div>

      {{ Form::submit('Submit', array('class' => 'btn btn-default')) }}

      {{ Form::close() }}
    </td>
    <td>
      @if($file->filetype == 'image')
      <img width='300' src='/fileserver/image/{{ $file->_id }}'></img>
      @else
      {{ substr($file->getFileData(), 0, 20) . '...' }}
      @endif
    </td>
  </tr>
</table>

@stop

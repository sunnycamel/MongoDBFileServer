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

<table class="table table-striped table-bordered">
  <tr>
    <td>
      File ID: {{ $file->_id }}<br/>
      File Name: {{ $file->filename }}<br/>
      File Type: {{ $file->filetype }}<br/>
      Key Words: {{ $file->keywords }}<br/>
      Description: {{ $file->description }}
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

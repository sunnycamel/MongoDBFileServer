@extends('fileserver::layouts.layout')
@section('left-nav-bar')
  <ul class="nav nav-pills nav-stacked">
    <li class="navbar-header alert-success">File Server</li>
    <li class="active"><a href="/fileserver">List</a></li>
    <li><a href="/fileserver/create">New File</a></li>
  </ul>
@stop
@section('content')
  @if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
  @endif
  {{ HTML::ul($errors->all()) }}

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <td>ID</td>
      <td>name</td>
      <td>type</td>
      <td>keywords</td>
      <td>description</td>
    </tr>
  </thead>
  <tbody>
    @foreach($files as $file)
    <tr>
      <td>{{ $file->_id }}</td>
      <td>{{ $file->filename }}</td>
      <td>{{ $file->filetype }}</td>
      <td>{{ $file->keywords }}</td>
      <td>{{ $file->description }}</td>
      <td>
	{{
	Form::open(array('url' => '/fileserver/' . $file->_id, 'class'=>'pull-right'))
	}}
	{{
	Form::hidden('_method', 'DELETE')
	}}
	{{
   	Form::submit('删除', array('class' => 'btn btn-warning'))
	}}
	{{
	Form::close()
	}}
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@stop

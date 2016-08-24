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
  {{ Html::ul($errors->all()) }}  

{{ Form::open(array('url' => '/fileserver', 'method' => 'get', 'class'=>'form-inline')) }}
  <div class="form-group">
     <div class="input-group">
     <input type="text" name='keywords' class="form-control" value='{{ Request::old('keywords')}}'placeholder="words in keywords or description">
     <span class="input-group-btn">
       <button type="submit" class="btn btn-search">Search</button>
     </span>
    </div>
  </div>
{{ Form::close() }}

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
	<a class="btn btn-small btn-success" href="{{ URL::to('/fileserver/' . $file->_id) }}">Show</a>
      </td>
      <td>
	<a class="btn btn-small btn-success" href="{{ URL::to('/fileserver/' . $file->_id . '/edit') }}">Edit</a>
      </td>
      <td>
	{{
	Form::open(array('url' => '/fileserver/' . $file->_id))
	}}
	{{
	Form::hidden('_method', 'DELETE')
	}}
	{{
   	Form::submit('Delete', array('class' => 'btn btn-warning pull-right'))
	}}
	{{
	Form::close()
	}}
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
      {{ $files->links() }}
@stop

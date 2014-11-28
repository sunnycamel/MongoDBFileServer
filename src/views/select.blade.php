@extends('fileserver::layouts.select')
@section('content')
{{ Form::open(array('url' => '/fileserver', 'method' => 'get', 'class'=>'form-inline')) }}
  <div class="form-group">
     <div class="input-group">
     <input type="text" name='keywords' class="form-control" value='{{ Input::old('keywords')}}'placeholder="words in keywords or description">
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
      <td>select</td>
    </tr>
  </thead>
  <tbody>
<form>
    @foreach($files as $file)
    <tr>
      <td>{{ $file->_id }}</td>
      <td>{{ $file->filename }}</td>
      <td>{{ $file->filetype }}</td>
      <td>{{ $file->keywords }}</td>
      <td>{{ $file->description }}</td>
      <td><input type='radio' name='selected' value='{{ $file->_id }}'></td>
    </tr>
    @endforeach
  </tbody>
</table>
      {{ $files->links() }}
</form>
@stop

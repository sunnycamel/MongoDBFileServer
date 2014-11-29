@extends('fileserver::layouts.select')
@section('content')
{{ Form::open(array('url' => '/fileserver/select', 'method' => 'get', 'class'=>'form-inline')) }}
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
    @foreach($files as $file)
    <tr>
      <td><a class='preview'>{{ $file->_id }}</a></td>
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

<div id='preview_dialog' style='display:none;'><img src="" id='preview' width='300'></img></div>
<div id='result' style='display:none;'></div>
<script>
  function onselect() {
      $('#result').text($( "input[type=radio]:checked" ).val());
  }
  $( "input[type=radio]" ).on( "click", onselect );
</script>

<script>
    $( ".preview" ).hover(
	function() {
	    $('#preview').attr('src','/fileserver/image/' + $(this).text());
	   
	    $('#preview_dialog').css({
		position:'absolute',
		left: $(window).width() - 500,
		top:  $(document).scrollTop() + 50
	    }).show();
	}, function() {
	    $('#preview_dialog').hide();
	}
    );
</script>
    
@stop

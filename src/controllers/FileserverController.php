<?php  namespace Three\Fileserver\Controllers; 

use Controller;
use View;
use Redirect;
use Input;
use Validator;
use Session;
use Three\Fileserver\Models\File;

class FileserverController extends Controller{

    public function index()
    {
         $files = File::all();
         return View::make('fileserver::index')->with('files', $files);
    }

    public function create()
    {
         return View::make('fileserver::create');
    }

    public function store()
    {
         $rules = array(
              'file'    => 'required',
              'filetype' => 'required',
              );
         $validator = Validator::make(Input::all(), $rules);

         if ($validator->fails()) {
              return Redirect::to('/fileserver/create')
                   ->withErrors($validator)
                   ->withInput();
         } else {
              $file = new File;
              $file->filename    = Input::get('file')->getClientOriginalName();
              $file->filetype    = Input::get('filetype')==0 ? 'image' : 'file';
              $file->keywords    = Input::get('keywords');
              $file->description = Input::get('description');
              $file->fileData    = \File::get(Input::get('file')->getRealPath());

              $ret = $file->save();
              if($ret) {
                   Session::flash('message', 'Successfully stored file!');
              }
              else {
                   Session::flash('message', 'Failed to stor file!');
              }

              return Redirect::to('/fileserver');
         }
    }

    public function show($id)
    {

    }
    
    public function edit($id)
    {

    }

    public function update($id)
    {

    }

    public function destroy($id)
    {
         $file = FileServer::find($id);
         if($file) {
              $file->delete();
         }
 
         return Redirect::to('fileserver');
    }
    
} 
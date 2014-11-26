<?php  namespace Three\Fileserver\Controllers; 

use Controller;
use View;
use Redirect;
use Input;
use Validator;
use Session;
use Response;
use Three\Fileserver\Models\File;

class FileserverController extends Controller{

    public function index()
    {
         $keywords = Input::get('keywords');
         if($keywords) {
              $ret = array_map('trim', explode(" ", $keywords));
              $first = TRUE;
              foreach($ret as $keyword) {
                   if($first) {
                        $temp = File::where('keywords', 'like', '%' . $keyword . '%')
                             ->orWhere('description', 'like', '%' . $keyword . '%');
                        $first = FALSE;
                   }
                   else {
                        $temp = $temp->orWhere('keywords', 'like', '%' . $keyword . '%')
                             ->orWhere('description', 'like', '%' . $keyword . '%');
                   }
              }
              $files = $temp->paginate(3);
         }
         else {
              $files = File::paginate(3);
         }

         $files->appends(
               array(
                    'keywords'  => Input::get('keywords'),
                    ));

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
              $file->filename    = Input::file('file')->getClientOriginalName();
              $file->filetype    = Input::get('filetype')==0 ? 'image' : 'file';
              $file->keywords    = Input::get('keywords');
              $file->description = Input::get('description');
              $file->filedata    = \File::get(Input::file('file')->getRealPath());

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
         $file = File::find($id);

         return View::make('fileserver::show')->with('file', $file);
    }
    
    public function edit($id)
    {
         $file = File::find($id);
         
         return View::make('fileserver::edit')->with('file', $file);
    }

    public function update($id)
    {
         $rules = array(
              'filetype' => 'required',
              );
         $validator = Validator::make(Input::all(), $rules);

         if ($validator->fails()) {
              return Redirect::to('/fileserver/' . '$id' .'/edit')
                   ->withErrors($validator)
                   ->withInput();
         } else {
              $file = File::find($id);
              $file->filetype    = Input::get('filetype')==0 ? 'image' : 'file';
              $file->keywords    = Input::get('keywords');
              $file->description = Input::get('description');

              $ret = $file->save(array('update' => TRUE));
              if($ret) {
                   Session::flash('message', 'Successfully stored file!');
              }
              else {
                   Session::flash('message', 'Failed to stor file!');
              }

              return Redirect::to('/fileserver');
         }
    }

    public function destroy($id)
    {
         $file = File::find($id);

         if($file) {
              $file->delete();
         }
 
         return Redirect::to('fileserver');
    }

    public function image($id)
    {
         $image = File::find($id)->getFileData();
         
         return Response::make($image, 200, array('content-type' => 'image/*'));
    }
    
} 
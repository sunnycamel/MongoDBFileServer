<?php  namespace Three\Fileserver\Controllers; 

use View;
use Redirect;
use Validator;
use Session;
use Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use Three\Fileserver\Models\File;

class FileserverController extends Controller{

    public function index(Request $request)
    {
         $keywords = $request->input('keywords');
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
              $files = $temp->paginate(10);
         }
         else {
              $files = File::paginate(10);
         }

         $files->appends(
               array(
                    'keywords'  => $keywords,
                    ));

         return View::make('fileserver::index')->with('files', $files);
    }

    public function select(Request $request)
    {
         $keywords = $request->input('keywords');
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
              $files = $temp->paginate(10);
         }
         else {
              $files = File::paginate(10);
         }

         $files->appends(
               array(
                    'keywords'  => $keywords,
                    ));

         return View::make('fileserver::select')->with('files', $files);
    }

    public function create()
    {
         return View::make('fileserver::create');
    }

    public function store(Request $request)
    {
         $rules = array(
              'file'    => 'required',
              'filetype' => 'required',
              );
         $validator = Validator::make($request->all(), $rules);

         if ($validator->fails()) {
              return Redirect::to('/fileserver/create')
                   ->withErrors($validator)
                   ->withInput();
         } else {
              $file = new File;
              $file->filename    = $request->file('file')->getClientOriginalName();
              $file->filetype    = $request->get('filetype')==0 ? 'image' : 'file';
              $file->keywords    = $request->get('keywords');
              $file->description = $request->get('description');
              $file->filedata    = \File::get($request->file('file')->getRealPath());

              $ret = $file->save();
              if($ret) {
                   Session::flash('message', 'Successfully stored file!');
              }
              else {
                   Session::flash('message', 'Failed to store file!');
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

    public function update(Request $request, $id)
    {
         $rules = array(
              'filetype' => 'required',
              );
         $validator = Validator::make($request->all(), $rules);

         if ($validator->fails()) {
              return Redirect::to('/fileserver/' . '$id' .'/edit')
                   ->withErrors($validator)
                   ->withInput();
         } else {
              $file = File::find($id);
              $file->filetype    = $request->get('filetype')==0 ? 'image' : 'file';
              $file->keywords    = $request->get('keywords');
              $file->description = $request->get('description');

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
<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index()
    {
        $files = File::all();
        return view('index', compact('files'));
    }


    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'file' => 'required'
        ]);

        $file = $request->file('file');
        // dd($file);
        if($file!=null)
        {
            $file_name = rand(123456, 999999) . '.' . $file->getClientOriginalExtension();
            $file_path = public_path('/files');
            $file->move($file_path, $file_name);
        }
        

        $file = new File();
        $file->name = $request->name;
        $file->file = $file_name;

        $file->save();

        return redirect()->route('home');

    }


    public function edit($id)
    {
        $file = File::find($id);
        return view('edit', compact('file'));
    }

    public function update(Request $request, $id)
    {
        $file = File::find($id);

        $file_name = $file->file;

        $file_path = public_path('files/' . $file_name);

        if($request->hasFile('file'))
        {
            unlink($file_path);

            $f = $request->file('file');
            $file_ext = $f->getClientOriginalExtension();
            $file_name = rand(123456, 999999). '.' .$file_ext;
            $file_path = public_path('files/');
            $f->move($file_path, $file_name);
            $file->file = $file_name;
        }
        else
        {
            $file->file = $request->old_file;
        }

        $file->name = $request->name;
        $file->save();

        return redirect()->route('home');
    }

    public function delete($id)
    {
        $file = File::find($id);

        $file_name = $file->file;

        $file_path = public_path('files/' .$file_name);
        unlink($file_path);

        $file->delete();
        return redirect()->route('home');
    }
}

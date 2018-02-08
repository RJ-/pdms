<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class uploadController extends Controller
{
    public function index()
    {
      return view('upload.upload');
    }

    public function store(Request $request)
    {
       $request->file('image');
       if ($request->hasFile('image')) {
         //return $request->image->store('public');
         return $request->image->storeAs('public','bitfumes.jpg');
         //return Storage::putFile('public', $request->file('image'));
       }else {
         return 'No file Selected';
       }
    }

    public function show()
    {
      $url = Storage::url('bitfumes.jpg');
      return "<img src='".$url."' / width='300'>";
      //return Storage::allFiles('public');
    }
}

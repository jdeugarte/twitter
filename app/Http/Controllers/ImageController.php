<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\ImageRequest;
use Auth;
use App\User;


class ImageController extends Controller {

	/**
	 * Show the form for uploading a new resource.
	 *
	 * @return Response
	 */
	public function upload(){
		// Redirect to image upload form
		return view('imageupload');
   	}

	/**
	 * Store a newly uploaded resource in storage.
	 *
	 * @return Response
	 */
	public function store(ImageRequest $request){
		// Store records process
		$input = $request->all();
		$image = new Image();
		$this->validate($request, [
            'title' => 'required',
            'image' => 'required'
        ]);
        $image->title = $request->title;
        $image->description = $request->description;
        $image->user_id = Auth::user()->id;
		if($request->hasFile('image')) {
            $file = Input::file('image');
            $name = time(). '-' .$file->getClientOriginalName();
            $image->filePath = $name;

            $file->move(public_path().'/images/', $name);
        }
        $image->save();
        $user = Auth::user();
        return view('home',compact('user'));
   	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function show(){
		// Show lists of the images
		$images = Image::all();
        return view('showLists', compact('images'));
    }

}

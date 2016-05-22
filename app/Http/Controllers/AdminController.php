<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use Session;
use Illuminate\Support\Facades\Input;
use App\Name;
use App\Image;
use Img;

class AdminController extends Controller
{
    public function index()
    {
    	return view('admin.home');
    }


    /**
     * @return Forms to upload and edit
     */

    public function new()
    {
    	return view('admin.new');
    }

    public function newImage()
    {
    	$names = Name::all();
    	return view('admin.newImage')->withNames($names);
    }

    public function edit()
    {
    	return view('admin.edit');
    }


    /**
     * Stores changes submited
     */

    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required',
        ]);

    	if ($validator->fails()){
    			Session::flash('message', 'Place was Not added!');
    			return redirect('admin');
		}

        $id = Image::all()->last()->id + 1;
    	$path = 'img/' . $id . '.' . Input::file('image')->getClientOriginalExtension();
    	Img::make(Input::file('image'))->fit(800, 800)->save($path, 100);

		$name = Name::create(['name' => $request->name]);
    	$name->images()->create([
    			'difficulty' => $request->difficulty,
    			'path' => $path
    		]);

    	Session::flash('message', 'Place added successfully');
    	return redirect('admin');
    }

    public function storeImage(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required',
        ]);

    	if ($validator->fails()){
    			Session::flash('message', 'Place was Not added!');
    			return redirect('admin');
		}

		$id = Image::all()->last()->id + 1;
    	$path = 'img/' . $id . '.' . Input::file('image')->getClientOriginalExtension();
    	Img::make(Input::file('image'))->fit(800, 800)->save($path, 100);

    	$name = Name::find($request->name);
    	$name->images()->create([
    			'difficulty' => $request->difficulty,
    			'path' => $path
    		]);

    	Session::flash('message', 'Place added successfully');
    	return redirect('admin');
    }
}

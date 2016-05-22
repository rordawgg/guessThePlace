<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Name;
use App\Image;


class GameController extends Controller
{
    public function index(Request $request)
    {   
        if(count($request->session()->get('old.imgs', [0])) === (Image::count() - 5)){
           $request->session()->forget('old.imgs');
        }

        if($request->session()->get('diff') <= 3){
            $places = Image::whereNotIn('id', $request->session()->get('old.imgs', [0]))
                    ->where('difficulty', $request->session()->get('diff', 1))
                    ->get()
                    ->unique('name_id')
                    ->random(5)
                    ->load('name');
        }else{
            $places = Image::all()
                    ->unique('name_id')
                    ->random(5)
                    ->load('name');
        }
    	$true = $places->random();
    	$request->session()->put('true', $true->name);
    	$request->session()->push('old.imgs', $true->id);

    	return view('home')->withPlaces($places)->withTrue($true);
    }

    public function score(Request $request)
    {
        /**
         * Handles Score
         */
    	if($request->name === $request->session()->pull('true')->name){
            $correctRes = array("Yes!", "Correct!", "Indeed!", "Good Job!", "Right On!", "Right You Are!");
    		$score = $request->session()->pull('correct', 0);
    		$request->session()->put('correct', $score + 1);
    		$request->session()->put('message', $correctRes[rand(0, count($correctRes) - 1)]);
            $request->session()->flash('class', 'true');
    	}else{
            $incorrectRes = array("No!", "Incorrect!", "Wrong!", "Seriously?", "You Suck!", "Um No");
    		$score = $request->session()->pull('incorrect', 0);
    		$request->session()->put('incorrect', $score + 1);
    		$request->session()->put('message', $incorrectRes[rand(0, count($incorrectRes) - 1)]);
            $request->session()->flash('class', 'false');
    	}

        /**
         * Handles Difficulty related to score
         */
    	$correct = $request->session()->get('correct');
    	if ($correct < 5) {
            $diff = 1;
        } else if (($correct >= 5) && ($correct < 10)) {
            $diff = 2;
        } else if (($correct >= 10) && ($correct < 20)){
            $diff = 3;
        }else {
            $diff = 4;
        }
        $request->session()->put('diff', $diff);


        /**
         * Handles Game Over
         */
        if($request->session()->get('incorrect') == 5){
            $request->session()->put('message', 'GAME OVER!');
            return $this->reset($request);
        }else{
            return back();
        }
    }


    public function reset(Request $request)
    {
    	$request->session()->put('correct', 0);
    	$request->session()->put('incorrect', 0);
		$request->session()->forget('old.imgs');
		$request->session()->put('diff', 1);
    	return back();
    }
}

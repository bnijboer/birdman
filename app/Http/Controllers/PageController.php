<?php

namespace App\Http\Controllers;

use App\Models\Behavior;
use App\Models\Habitat;
use App\Models\Color;
use App\Models\Shape;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * View home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $features = [
            'behaviors' => Behavior::all(),
            'colors' => Color::all(),
            'habitats' => Habitat::all(),
            'shapes' => Shape::all()
        ];
        
        return view('home', compact('features'));
    }
}

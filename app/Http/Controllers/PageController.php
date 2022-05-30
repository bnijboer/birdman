<?php

namespace App\Http\Controllers;

use App\Models\Bird;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('home');
    }
    
    public function search(Request $request)
    {
        $colorIds = explode(' ', $request->color);
        $habitatIds = explode(' ', $request->habitat);
        
        $birds = Bird::whereHas('colors', function($query) use($colorIds) {
            $query->whereIn('color_id', $colorIds);
        })
        ->whereHas('habitats', function($query) use($habitatIds) {
            $query->whereIn('habitat_id', $habitatIds);
        })
        ->get();
        
        return response()->json([
            'birds' => $birds,
        ]);
    }
}

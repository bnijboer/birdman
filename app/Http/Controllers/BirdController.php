<?php

namespace App\Http\Controllers;

use App\Models\Bird;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Undefined;

class BirdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if ($request->color !== 'all') {
            $colorIds = explode(' ', $request->color);
        } else {
            $colorIds = false;
        }
        
        if ($request->behavior !== 'all') {
            $behaviorIds = explode(' ', $request->behavior);
        } else {
            $behaviorIds = false;
        }
        
        if ($request->shape !== 'all') {
            $shapeIds = explode(' ', $request->shape);
        } else {
            $shapeIds = false;
        }
        
        if ($request->habitat !== 'all') {
            $habitatIds = explode(' ', $request->habitat);
        } else {
            $habitatIds = false;
        }
        
        $birds = Bird::when($colorIds, function ($query, $colorIds) {
                        $query->whereHas('colors', function($query) use($colorIds) {
                            $query->whereIn('color_id', $colorIds);
                        });
                    })->when($behaviorIds, function ($query, $behaviorIds) {
                        $query->whereHas('behaviors', function($query) use($behaviorIds) {
                            $query->whereIn('behavior_id', $behaviorIds);
                        });
                    })->when($shapeIds, function ($query, $shapeIds) {
                        $query->whereHas('shapes', function($query) use($shapeIds) {
                            $query->whereIn('shape_id', $shapeIds);
                        });
                    })->when($habitatIds, function ($query, $habitatIds) {
                        $query->whereHas('habitats', function($query) use($habitatIds) {
                            $query->whereIn('habitat_id', $habitatIds);
                        });
                    })->get();
        
        return response()->json([
            'birds' => $birds,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bird  $bird
     * @return \Illuminate\Http\Response
     */
    public function show(Bird $bird)
    {
        //
    }
}

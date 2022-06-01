<?php

namespace App\Http\Controllers;

use App\Models\Bird;
use Illuminate\Http\Request;

class BirdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = array_map(function($values) {
            return explode(' ', $values);
        }, $request->all());
        
        $birds = Bird::query();
        
        foreach($params as $traits => $ids) {
            $trait = (string) str($traits)->singular;
            
            $birds = $birds->when($trait, function ($query) use ($trait, $traits, $ids) {
                $query->whereHas("{$traits}", function ($query) use ($trait, $ids) {
                    $query->whereIn("{$trait}_id", $ids);
                });
            });
        }
        
        $birds = $birds->get();
                    
        return response()->json(compact('birds'));
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

<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Vehicle;

class VehicleController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            $vehicles = Vehicle::all();
          
            return response()->json(['data' => $vehicles], 200);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
            //find one vehicle
            $vehicle = Vehicle::find($id);

            return response()->json(['data' => $vehicle], 200); 
            
            //IS the same as THIS: Meaning returns JSON by dedault
            //return response(['data' => $vehicle], 200); 
            
            
	}

        
}

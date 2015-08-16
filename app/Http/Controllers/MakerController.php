<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Maker;
use App\Vehicle;
use App\Http\Requests\CreateMakerRequest;

//added to support caching
use Illuminate\Support\Facades\Cache;

class MakerController extends Controller
{
        public function __construct()
        {   //require authentication
            //$this->middleware('auth.basic.once', ['except' => ['index', 'show']]);
            $this->middleware('oath', ['except' => ['index', 'show']]);
        }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
           // $makers = Maker::all();
        
         //with PAGINATION
        $makers = Maker::simplePaginate(10);
            
        //THIS CACHING doesn't work in 5.1
        //5.1 now requires using DB, Memcached, or REDIS
         //using cache, remember and only update , in minutes
 /*           //$makers = Cache::remember('makers',  2, function () {
           $makers = Cache::remember('makers',  15/60, function () {
                return Maker::all();
                
                //with PAGINATION
                //return Maker::simplePaginate(15);
            });
*/
           // return response()->json(['data' => $makers], 200);
            
            //RETURNS JSON by default
           // return response(['data' => $makers], 200);
            
            //with PAGINATION
            return response(['next' => $makers->nextPageUrl(), 
                'previous' => $makers->previousPageUrl(), 
                'data' => $makers->items()], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateMakerRequest $request)
    {
        $values = $request->only(['name', 'phone']);

            Maker::create($values);

           return  response()->json(['message' => 'Maker correctly added'], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int      $id
     * @return Response
     */
    public function show($id)
    {
            $maker = Maker::find($id);

            if (!$maker) {
                return response()->json(['message' => 'This maker does not exist',
                    'code' => 404], 404);
                
                //it's the same whether or not you use ->json method
//                return response(['message' => 'This maker does not exist',
//                    'code' => 404], 404);
            }

            return response()->json(['data' => $maker], 200);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int      $id
     * @return Response
     */
    public function update(CreateMakerRequest $request, $id)
    {
            $maker = Maker::find($id);

            if (!$maker) {
                return response()->json(['message' => 'This maker does ot exist',
                    'code' => 404], 404);
            }

            $name = $request->get('name');
            $phone = $request->get('phone');

            $maker->name = $name;
            $maker->phone = $phone;

            $maker->save();

            return response()->json(['message' => 'The maker has been updated'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int      $id
     * @return Response
     */
    public function destroy($id)
    {
            $maker = Maker::find($id);

            if (!$maker) {
                return response()->json(['message' => 'This maker does ot exist',
                    'code' => 404], 404);
            }

            $vehicles = $maker->vehicles;

            if (sizeof($vehicles) > 0) {
                return response()->json(['message' => 'This maker has associated vehicles. Delete the vehicles first',
                    'code' => 409], 409);

            }

            $maker->delete();

            return response()->json(['message' => 'The maker has been deleted'], 200);

    }

}

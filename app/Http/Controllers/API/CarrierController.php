<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Carrier;
use APP\Helper\ClicknShipAPI;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class CarrierController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Carriers = Carrier::all();


        return $this->sendResponse($Carriers->toArray(), 'Carriers retrieved successfully.');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        if(!empty($input)){
        $origin  = $input['rate']['origin'];
        $destination = $input['rate']['destination'];


      //  $name= json_decode(Auth::user());
       // $user = DB::table('users')->where('name', $url)->first();
      //  dd($user);
        // Calculate shipping
        // if (isset($destination)){
        //         $token = ClicknShipAPI::getToken();
        // }
        }
       //exit;
     /*   $validator = $request->validate($input, [
         'carrierId' => 'required',
            'name' => 'required'
        ]);
*/



       // $product = Carrier::create($input);

            $response = ['service_name' => 'ClicknShip Shipping', 
              'description' => 'Nationwide Click and Shiip shipping', 
              'service_code' => 'Fast Shipping',
              'currency_code' => 'NGN',
              'currency' => 'Naira',
              'total_price' => '1950',
            ];
        return $this->sendResponse($response, 'Carrier created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carrier = Carrier::find($id);


        if (is_null($carrier)) {
            return $this->sendError('Carrier not found.');
        }


        return $this->sendResponse($carrier->toArray(), 'Carrier retrieved successfully.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carrier $carrier)
    {
        $input = $request->all();


        $validator = $request->validate($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);


        // if($validator->fails()){
        //     return $this->sendError('Validation Error.', $validator->errors());       
        // }


        $carrier->name = $input['name'];
        $carrier->detail = $input['detail'];
        $carrier->save();


        return $this->sendResponse($carrier->toArray(), 'Carrier updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carrier $carrier)
    {
        $carrier->delete();


        return $this->sendResponse($carrier->toArray(), 'Carrier deleted successfully.');
    }
}
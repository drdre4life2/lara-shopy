<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Carrier;
use  App\Helper\ClicknShipAPI;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CarrierController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function privacy()
    {

        return view('dashboard.privacy');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $method = strtoupper($request->getMethod());
        $uri = $request->getPathInfo();
        $bodyAsJson = json_encode($request->except(config('http-logger.except')));
        $message = "{$method} {$uri} - {$bodyAsJson}";
        Log::info($message);

        $shop = Auth::user();
        $shop_url = $shop->getDomain()->toNative();
        //$shop_url = 'ggh';

        $shop = DB::table('clicknships')->where('shop_url', $shop_url)->first();
        $store_city = $shop->store_city;
        $token = ClicknShipAPI::getToken($shop->username, $shop->password);
        $token = json_encode($token, true);
        $token = json_decode($token, true);
       // $token = $token;
        $token = $token['access_token'];
        $input = json_encode($request->all());
        if(!empty($input)){
        $origin  = $request->all();
        //$city = $origin['rate']['origin']['city'];
        $city = $store_city;
        $destination = $origin['rate']['destination']['city'];
        
    // log the raw request -- this makes debugging much easier
    $filename = time();
    // $input = file_get_contents('php://input');
     file_put_contents($filename . '-input', $input);

     // parse the request
    $rates = json_decode($input, true);
   // $rates = $input;
//rint_r($rates);
//exit;
     // log the array format for easier interpreting
     //file_put_contents($filename . '-debug', print_r($rates, true));

     // total up the cart quantities for simple rate calculations
     $quantity = 0;
     foreach ($rates['rate']['items'] as $item) {
         $quantity = +$item['quantity'];
     }

     $weight = 0;
     foreach ($rates['rate']['items'] as $item) {
         $weight = +$item['grams'];
     }
    $weight  = $weight/1000;
    $shippin_details = ['origin' => $city,'destination' =>$destination,
      'token' =>$token,
     'weight' =>$weight
    ];
     $cost = ClicknShipAPI::calculateDeliveryFee($shippin_details);
    // print_r($shippin_details);

    //return amount to shopify in kobo
     $final_cost = $cost[0]->TotalAmount * 100;
     $final_cost = 
     //exit;
     // use number_format because shopify api expects the price to be "25.00" instead of just "25"

     // overnight shipping is 5.50 per item
     $overnight_cost = number_format($quantity * 5.50, 2, '', '');
     // regular shipping is 2.75 per item
     $regular_cost = number_format($quantity * 2.75, 2, '', '');

     // overnight shipping is 1 to 2 days after today
     $on_min_date = date('Y-m-d H:i:s O', strtotime('+1 day'));
     $on_max_date = date('Y-m-d H:i:s O', strtotime('+2 days'));

     // regular shipping is 3 to 7 days after today
     $reg_min_date = date('Y-m-d H:i:s O', strtotime('+3 days'));
     $reg_max_date = date('Y-m-d H:i:s O', strtotime('+7 days'));

     // build the array of line items using the prior values
     $output = array('rates' => array(
         array(
             'service_name' => 'Clicknship Shipping',
             'service_code' => 'Regular',
             'total_price' => $final_cost,
             'currency' => 'NGN',
             'min_delivery_date' => '',
             'max_delivery_date' => ''
         )
         
     ));

     // encode into a json response
     $json_output = json_encode($output);

     // log it so we can debug the response
     file_put_contents($filename . '-output', $json_output);

     return $json_output;
     // send it back to shopify
     //print $json_output;

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
        return json_encode($response, JSON_PRETTY_PRINT);
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

    public function customerRedact(Request $request)
    {

     $response = [200, 'ok'];
        return json_encode($response, JSON_PRETTY_PRINT);

    }

    public function shopRedact(Request $request)
    {

     $response = [200, 'ok'];
        return json_encode($response, JSON_PRETTY_PRINT);

    }
    public function dataRequest(Request $request)
    {

     $response = [200, 'ok'];
        return json_encode($response, JSON_PRETTY_PRINT);

    }
}
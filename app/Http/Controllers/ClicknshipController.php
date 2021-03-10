<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clicknship;
use Illuminate\Support\Facades\Hash;    
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ClicknshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    return view('dashboard.dashboard');
    }

    public function logRequest(Request $request): void
    {
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
 
            $data = $request->all();
            $key = env('SHOPIFY_API_KEY');
            $pass = env('SHOPIFY_API_SECRET');
           // dd($pass);
            
           // dd($data);
            $password = $data['pwd']; // get the value of password field

            // Hash Password
            //Hash::check('INPUT PASSWORD', $user->password);

           // $hashed = Hash::make($password); // encrypt the password
            
            $validatedData = $request->validate([
                'username' => 'required|unique:clicknships',
                'pwd' => 'required',
                'phone' => 'required',
                'store_city' => 'required',
                'LocationId' => 'required',
                
            ]);
           $name= json_decode(Auth::user());
           //$url = $name->name;
            // Create new record in the DB
            $new =  Clicknship::create([
                'username'=>$data['username'],
                'password' => $password,
                'phone' => $data['phone'],
                'store_city' => $data['store_city'],
                'locationId' => $data['LocationId'],
                'shop_url' => 'ggh',
                ]);

        $params   = array(
            "carrier_service" =>[
            "name" => "ClickNShip Shipping",
            "callback_url" => "lara-shopy.herokuapp.com/api/carriers",
            "service_discovery" => "true"
            ]
        );

        $payload = json_encode($params);
                if($new == true){
                //    create Carrier
                     $shop = Auth::user();
                //     $request = $shop->api()->rest('POST', '/admin/api/2021-01/carrier_services.json', ["carrier_service"
                //     =>["name"=>"ClicknShip Shipping", "callback_url" => "http://lara-shopy.herokuapp.com/carrier",
                //     "service_discovery"=> "true"]
                //    ]);


                   $curl = curl_init();
                  // dd($shop['name']);
                   curl_setopt_array($curl, array(
                     CURLOPT_URL => "https://techstests.myshopify.com/admin/api/2021-01/carrier_services.json",
                     CURLOPT_RETURNTRANSFER => true,
                     CURLOPT_ENCODING => "",
                     CURLOPT_MAXREDIRS => 10,
                     CURLOPT_TIMEOUT => 30,
                     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                     CURLOPT_CUSTOMREQUEST => "POST",
                     CURLOPT_POSTFIELDS => "\n{\n\"carrier_service\": {\n    \"name\":
                         \"Clicknship Rate Provider\",\n    \"callback_url\":
                          \"http://lara-shopy.herokuapp.com/carrier\",\n    \"service_discovery\": true\n  }\n}",
                     CURLOPT_HTTPHEADER => array(
                       "cache-control: no-cache",
                       "content-type: application/json"
                     ),
                   ));
                   
                   $response = curl_exec($curl);
                   $err = curl_error($curl);
                   
                   curl_close($curl);
                   
                   if ($err) {
                     dd($err);
                   } else {
                      dd($response);
                   }

                   
                   return redirect()->route('confirm');

                }else{
                    
                    return Redirect::back()->with('msg', 'We already have your records');

                }
            }else{

               // print_r('test');
            return view('dashboard.index');
        }
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Confirm(Request $request)
    {
        return view('dashboard.confirm');

        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

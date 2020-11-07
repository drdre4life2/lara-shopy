<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clicknship;
use Illuminate\Support\Facades\Hash;    
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;


class ClicknshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
           // dd($data);
            $password = $data['pwd']; // get the value of password field

            // Hash Password
            //Hash::check('INPUT PASSWORD', $user->password);

            $hashed = Hash::make($password); // encrypt the password
            
            $validatedData = $request->validate([
                'username' => 'required|unique:clicknships',
                'pwd' => 'required',
                'phone' => 'required',
                'store_city' => 'required',
                'LocationId' => 'required',
                
            ]);
           $name= json_decode(Auth::user());
           $url = $name['name'];
            // Create new record in the DB
            $new =  Clicknship::create([
                'username'=>$data['username'],
                'password' => $hashed,
                'phone' => $data['phone'],
                'store_city' => $data['store_city'],
                'locationId' => $data['LocationId'],
                'shop_url' => $name,
                ]);
                if($new == true){
                    //create Carrier

                    $curl = curl_init();
                    
                    curl_setopt_array($curl, array(
                      CURLOPT_URL => "http://post/%20/admin/api/2020-10/carrier_services.json",
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => "",
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 30,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => "POST",
                      CURLOPT_POSTFIELDS => "{\n  \"carrier_service\": {\n    \"name\": \"ClickNShip\",\n    \"callback_url\": \"http://addartech.com\",\n    \"service_discovery\": true\n  }\n}",
                      CURLOPT_HTTPHEADER => array(
                        "cache-control: no-cache",
                        "content-type: application/json",
                      ),
                    ));
                    
                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    
                    curl_close($curl);
                    
                    if ($err) {
                      echo "cURL Error #:" . $err;
                    } else {
                      echo $response;
                    }

                return Redirect::back()->with('msg', 'Your store details are saved successfully');
                }else{
                    return Redirect::back()->with('msg', 'WE already have your records');

                }
            }else{
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
    public function CreateClicknship(Request $request)
    {


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

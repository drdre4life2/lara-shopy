<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clicknship;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            $password = $data['pwd']; // get the value of password field
            $validatedData = $request->validate([
                'username' => 'required|unique:clicknships',
                'pwd' => 'required',
                'phone' => 'required',
                'store_city' => 'required',
                'LocationId' => 'required',
            ]);
          //  $name = json_decode(Auth::user());
            //$test_url = 'ggh';
            $shop = Auth::user();
            $shop_url = $shop->getDomain()->toNative();
            $url = DB::table('clicknships')->where('shop_url', $shop_url)->first();

            // Check if shop Url already exist before creating ne records
            if(is_null($url)){
                $new =  Clicknship::create([
                    'username' => $data['username'],
                    'password' => $password,
                    'phone' => $data['phone'],
                    'store_city' => $data['store_city'],
                    'locationId' => $data['LocationId'],
                    'shop_url' => $shop_url,
                ]);
            }else{
                return Redirect::back()->with('msg', 'We already have your records');

            }
            if ($new == true) {
                //    create Carrier
                $shop = Auth::user();
                    $request = $shop->api()->rest('POST', '/admin/api/2021-01/carrier_services.json', ["carrier_service"
                    =>["name"=>"ClicknShip Shipping", "callback_url" => "http://lara-shopy.herokuapp.com/carrier",
                    "service_discovery"=> "true"]
                   ]);

                return redirect()->route('confirm');
            } else {

                return Redirect::back()->with('msg', 'We already have your records');
            }
        } else {

            $shop = Auth::user();
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

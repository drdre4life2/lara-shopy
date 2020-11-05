<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clicknship;
use Illuminate\Support\Facades\Hash;    
use Illuminate\Support\Facades\Redirect;

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

            
            $new =  Clicknship::create([
                'username'=>$data['username'],
                'password' => $hashed,
                'phone' => $data['phone'],
                'store_city' => $data['store_city'],
                'locationId' => $data['LocationId'],
                ]);
                if($new == true){
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
    public function store(Request $request)
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

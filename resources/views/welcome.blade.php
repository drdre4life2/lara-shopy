@extends('shopify-app::layouts.default')
@include('layouts.app')

@section('content')

    <!-- You are: (shop domain name) -->
    <div class="container">
    <p></p>
  <h4>Enter ClicknShip details for {{ Auth::user()->name }}</h2>
  <p>
    
  </p>

  @if(Session::has('success'))
    <div class="alert-box success">
        <h2>{{ Session::get('msg') }}</h2>
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="form-horizontal" enctype="multipart/form-data"   action="click-save" method="post">
  {{ csrf_field() }}

    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Username:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="text" placeholder="Enter clicknship API username" name="username">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="pwd" placeholder="Enter ClicknShip API password" name="pwd">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="phone">Store Phone Number</label>
      <div class="col-sm-10">          
        <input type="number" class="form-control" id="phone" placeholder="Primary Store City" name="phone">
      </div>
    </div>
     <div class="form-group">
     <label for="sel1">Primary Store city:</label>
     <select class="form-control" id="sel1" name="store_city">
     <option value="" ></option>
													<option value="Aba" >Aba</option>
													<option value="Abakaliki" >Abakaliki</option>
													<option value="Abeokuta" >Abeokuta</option>
													<option value="Abuja" >Abuja</option>
													<option value="Ado Ekiti" >Ado Ekiti</option>
													<option value="Akure" >Akure</option>
													<option value="Asaba" >Asaba</option>
													<option value="Awka" >Awka</option>
													<option value="Bauchi" >Bauchi</option>
													<option value="Benin" >Benin</option>
													<option value="Birnin Kebbi" >Birnin Kebbi</option>
													<option value="Bonny" >Bonny</option>
													<option value="Calabar" >Calabar</option>
													<option value="Damaturu" >Damaturu</option>
													<option value="Dutse" >Dutse</option>
													<option value="Eket" >Eket</option>
													<option value="Gombe" >Gombe</option>
													<option value="Gusau" >Gusau</option>
													<option value="Ibadan"  selected='selected'>Ibadan</option>
													<option value="Ijebu Ode" >Ijebu Ode</option>
													<option value="Ikot Ekpene" >Ikot Ekpene</option>
													<option value="Ile-ife" >Ile-ife</option>
													<option value="Ilorin" >Ilorin</option>
													<option value="Jalingo" >Jalingo</option>
													<option value="Jos" >Jos</option>
													<option value="Kaduna" >Kaduna</option>
													<option value="Kano" >Kano</option>
													<option value="Kastina" >Kastina</option>
													<option value="Lafia" >Lafia</option>
													<option value="Lagos Island" >Lagos Island</option>
													<option value="Lokoja" >Lokoja</option>
													<option value="Maiduguri" >Maiduguri</option>
													<option value="Mainland" >Mainland</option>
													<option value="Makurdi" >Makurdi</option>
													<option value="Minna" >Minna</option>
													<option value="Nnewi" >Nnewi</option>
													<option value="Nsukka" >Nsukka</option>
													<option value="Ofa" >Ofa</option>
													<option value="Ogbomosho" >Ogbomosho</option>
													<option value="Onitsha" >Onitsha</option>
													<option value="Oshogbo" >Oshogbo</option>
													<option value="Owerri" >Owerri</option>
													<option value="Oyo" >Oyo</option>
													<option value="Port Harcourt" >Port Harcourt</option>
													<option value="Sagamu" >Sagamu</option>
													<option value="Sapele" >Sapele</option>
													<option value="Sokoto" >Sokoto</option>
													<option value="Suleja" >Suleja</option>
													<option value="Umuahia" >Umuahia</option>
													<option value="Uyo" >Uyo</option>
													<option value="Warri" >Warri</option>
													<option value="Yenagoa" >Yenagoa</option>
													<option value="Yola" >Yola</option>
													<option value="Zaria" >Zaria</option>
  </select>
   </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="locationId">Store Location ID</label>
      <div class="col-sm-10">          
        <input type="number" class="form-control" id="locationId" placeholder="Primary Store City" name="LocationId">
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-danger">Submit</button>
      </div>
    </div>
  </form>
</div>

    </div>
@endsection

@section('scripts')
    @parent

    <script type="text/javascript">
        var AppBridge = window['app-bridge'];
        var actions = AppBridge.actions;
        var TitleBar = actions.TitleBar;
        var Button = actions.Button;
        var Redirect = actions.Redirect;
        var titleBarOptions = {
            title: 'Welcome',
        };
        var myTitleBar = TitleBar.create(app, titleBarOptions);
    </script>
@endsection


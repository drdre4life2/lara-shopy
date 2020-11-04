@extends('shopify-app::layouts.default')
@include('layouts.app')

@section('content')

    <!-- You are: (shop domain name) -->
    <div class="container">
  <h2>Enter ClicknShip details for {{ Auth::user()->name }}</h2>
  <form class="form-horizontal" action="/action_page.php">
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
      <label class="control-label col-sm-2" for="city">Store City</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="city" placeholder="Primary Store City" name="city">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Store Location ID</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="locationId" placeholder="Primary Store City" name="LocationId">
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


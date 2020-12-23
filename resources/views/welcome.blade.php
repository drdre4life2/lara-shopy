@extends('shopify-app::layouts.default')

@include('layouts.app')
<br>
@section('content')
    <div class="container">
<!-- Main component for a primary marketing message or call to action -->
<div class="jumbotron">
  <h1>Welcome {{ Auth::user()->name }}</h1>
  <p>Click & Ship is an integrated application powered by RS Allied Solutions limited, a subsidiary of Red Star Express Plc. Designed primarily for E-commerce operations, efficient and effective transaction management, visibility and payment reconciliations.</p>
  <p>To begin, visit www.clicknship.com.ng</p>
  </p>
</div>

</div> <!-- /container -->

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
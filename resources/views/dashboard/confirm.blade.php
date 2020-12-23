
@include('layouts.app')
@section('content')

<div class="jumbotron text-center">
  <h1 class="display-3">Thank You!</h1>
  <p class="lead"><strong>Your account setup is now complete.</strong>please go to shipping settings in your shop and select clicknship shipping as your shipping carier .</p>
  <hr>
  <!-- <p>
    Having trouble? <a href="">Contact us</a>
  </p> -->
  <p class="lead">
    <a class="btn btn-primary btn-sm" href="{{ url('home') }}" role="button">Continue to homepage</a>
  </p>
</div>
@endsection
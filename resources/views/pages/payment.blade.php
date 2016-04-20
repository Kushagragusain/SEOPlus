@extends('layouts.app', ['link' => '', 'history' => ''])

@section('content')
<div class="card-header bgm-blue m-b-20">
                <h2>Please Subscribe to use our services!!<i class="zmdi zmdi-search zmdi-hc-fw"></i><small>First 30 days FREE TRIAL </small><small>Trial valid upto use of 2 url and 10 keywords</small><small>Pay $14.99 afterwards</small></h2>
            </div>
<div class="container">

        <div class="col-md-10 col-md-offset-1">

                <form action="new" method="POST">
            {{ csrf_field() }}
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_B7RvhOHa9kVakcik9jrD66be"
    data-amount="1499"
    data-name="MONTHLY SUBSCRIPTION"
    data-description="start your 30 days trial and pay afterwards"
    data-locale="auto">
  </script>
</form>


</div>
@endsection
@section('footer')
@endsection



@extends('layouts.app', ['link' => '', 'history' => ''])

@section('content')
<div class="container">

        <div class="col-md-10 col-md-offset-1">

                <form action="new" method="POST">
            {{ csrf_field() }}
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_B7RvhOHa9kVakcik9jrD66be"
    data-amount="1499"
    data-name="monthly"
    data-description="monthly"
    data-locale="auto">
  </script>
</form>


</div>
@endsection
@section('footer')
@endsection



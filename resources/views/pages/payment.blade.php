@extends('layouts.app', ['link' => '', 'history' => ''])

@section('content')
<div class="col-md-8">

            <div class="card-header bgm-blue">
                        </div><h1>Please Subscribe to use our services</h1>
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



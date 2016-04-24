@extends('layouts.app', ['link' => '', 'history' => ''])

@section('content')
 <section id="content">
                <div class="container c-alt">
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

                    <div class="text-center">
                        <h2 class="f-400">PAYMENT MADE SIMPLE</h2>
                        <p class="c-gray m-t-20 m-b-20">SEO-PLUS </p>
                    </div>

                    <div class="clearfix"></div>

                    <div class="row m-t-25">
                        <div class="col-sm-4">
                            <div class="card pt-inner">
                                <div class="pti-header bgm-amber">
                                    <h2>$14.99 <small>| mo</small></h2>
                                    <div class="ptih-title">Monthly Pack</div>
                                </div>

                                <div class="pti-body">
                                    <div class="ptib-item">
                                        Start your subscripton with one month free trial pack!!
                                    </div>
                                    <div class="ptib-item">
                                        just submit your details and click pay $14.99 but you will not be charged for the trial month
                                    </div>
                                    <div class="ptib-item">
                                        Only 2 urls and 10 keywords are allowed in monthly subscription!!
                                    </div>

                                </div>

                                <div class="pti-footer">
                                    <a href="" class="bgm-amber"><i class="zmdi zmdi-check"></i></a>
                                </div>
                            </div>
                        </div>




                    </div>
                </div>

            </section>
        </section>

<div class="container">

        <div class="col-md-10 col-md-offset-1">




</div>
@endsection
@section('footer')
@endsection



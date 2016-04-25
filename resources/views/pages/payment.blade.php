@extends('layouts.app', ['link' => '', 'history' => ''])

@section('content')

                    <div class="text-center">
                        <h2 class="f-400">PAYMENT MADE SIMPLE</h2>
                        <p class="c-gray m-t-20 m-b-20">SEO-PLUS </p>
                    </div>
                    <div class="row m-t-25">
                        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                            <div class="card pt-inner">
                                <div class="pti-header bgm-green">
                                    <h2>$14.99 <small>| mo</small></h2>
                                    <div class="ptih-title">Monthly Pack</div>
                                </div>

                                <div class="pti-body">
                                    <div class="ptib-item">
                                        Start your subscripton with first month free
                                    </div>
                                    <div class="ptib-item">
                                        The monthly pay is $14.99 but you will not be charged for the first trial month
                                    </div>
                                    <div class="ptib-item">
                                        2 urls and 10 keywords are allowed in monthly subscription
                                    </div>

                                </div>

                                <div class="pti-footer">
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

                            </div>
                        </div>
                    </div>



@endsection
@section('footer')
@endsection



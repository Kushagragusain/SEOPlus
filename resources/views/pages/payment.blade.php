@extends('layouts.app', ['link' => '', 'history' => ''])

@section('content')
 <section id="content">
                <div class="container c-alt">

                    <div class="text-center">
                        <h2 class="f-400">PAYMENT MADE SIMPLE</h2>
                        <p class="c-gray m-t-20 m-b-20">Cras pretium elementum lacus ac auctor. Sed id mi nec ex placerat iaculis. Suspendisse volutpat purus ac metus venenatis rutrum. Morbi sit amet dui in nisi lacinia varius. Aliquam vehicula molestie sagittis. Cras a lectus nulla. Nulla accumsan volutpat nibh at tristique. Aenean varius massa a euismod posuere. Sed at ante imperdiet, fermentum purus at, aliquam nulla. Mauris blandit elit ac ipsum fermentum, vitae consequat velit vestibulum. Vivamus convallis fermentum nunc et varius.</p>
                    </div>

                    <div class="clearfix"></div>

                    <div class="row m-t-25">
                        <div class="col-sm-4">
                            <div class="card pt-inner">
                                <div class="pti-header bgm-amber">
                                    <h2>$25 <small>| mo</small></h2>
                                    <div class="ptih-title">Banana Pack</div>
                                </div>

                                <div class="pti-body">
                                    <div class="ptib-item">
                                        Pellentesque habitant morbi tristique senectus et netusmalesuada fames ac turpis egestas. Suspendisse maximus imperdiet tristique.
                                    </div>
                                    <div class="ptib-item">
                                        In dapibus ipsum sit amet leo
                                    </div>
                                    <div class="ptib-item">
                                        Vestibulum ut mauris tellus. Donec
                                    </div>
                                    <div class="ptib-item">
                                        Purna lectus venenatis felis, nonsemper
                                    </div>
                                    <div class="ptib-item">
                                        Aliquam erat volutpat hasellus ultri
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



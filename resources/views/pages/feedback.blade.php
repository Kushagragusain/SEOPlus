@extends('layouts.app', ['link' => '', 'history' => 'History'])

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
            	<div class="card-body">
            		<ul class="tab-nav tn-justified tn-icon" role="tablist">
	                    <li role="presentation" class="active">
	                        <a class="col-xs-4" href="#tab-1" aria-controls="tab-1" role="tab" data-toggle="tab">
	                            Buying bid &nbsp; <i class="zmdi zmdi-case-download icon-tab c-blue  hidden-xs"></i>
	                        </a>
	                    </li>
	                    <li role="presentation" >
	                        <a class="col-sx-4" href="#tab-2" aria-controls="tab-2" role="tab" data-toggle="tab">
	                            Subscription bid &nbsp;<i class="zmdi zmdi-cloud-done icon-tab c-blue hidden-xs"></i>
	                        </a>
	                    </li>
	                </ul>
	                <div class="tab-content p-20">
	                	<div role="tabpanel" class="tab-pane animated fadeIn in active" id="tab-1">
	                		<div class="card">
			                    <div class="card-header bgm-blue m-b-20">
			                        <h2>Bid to buy</h2>
			                    </div>

			                    <div class="card-body" id="keywords_list">
			                        <div class="table-responsive">
			                            <table class="table table-hover">
			                              	<thead>
			                                	<tr>
			                                        <th>Email</th>
			                                        <th>Bid (in $)</th>
			                                    </tr>
											</thead>

			                                <tbody id="tbody">
			                                	@foreach( $buy_data as $b )
			                                		<tr>
			                                			<td>{{ $b->email }}</td>
			                                			<td>{{ $b->amount }}</td>
			                                		</tr>
			                                	@endforeach
			                                </tbody>
			                            </table>
			                        </div>
			                    </div>
			                    <br/>

			                    <div class="card-header bgm-blue m-b-20">
			                    	<h2>Average bid : {{ $buy_avg }} $</h2>
			                        <h2>Maximum bid : {{ $buy }} $</h2>
			                        <h2>Emails:</h2>
			                        @foreach( $buy_email as $e )
			                        	<h4>{{ $e->email }}</h4>
			                        @endforeach
			                    </div>
			                </div>
	                	</div>


	                	<div role="tabpanel" class="tab-pane animated fadeIn in" id="tab-2">
	                		<div class="card">
			                    <div class="card-header bgm-blue m-b-20">
			                        <h2>Bid to subscribe</h2>
			                    </div>

			                    <div class="card-body" id="keywords_list">
			                        <div class="table-responsive">
			                            <table class="table table-hover">
			                              	<thead>
			                                	<tr>
			                                        <th>Email</th>
			                                        <th>Bid (in $)</th>
			                                    </tr>
											</thead>

			                                <tbody id="tbody">
			                                	@foreach( $subscribe_data as $s )
			                                		<tr>
			                                			<td>{{ $s->email }}</td>
			                                			<td>{{ $s->amount }}</td>
			                                		</tr>
			                                	@endforeach
			                                </tbody>
			                            </table>
			                        </div>
			                    </div>
			                    <br/>

			                    <div class="card-header bgm-blue m-b-20">
			                    	<h2>Average bid : {{ $subscribe_avg }} $</h2>
			                        <h2>Maximum bid : {{ $subscribe }} $</h2>
			                        <h2>Emails:</h2>
			                        @foreach( $subscribe_email as $e )
			                        	<h4>{{ $e->email }}</h4>
			                        @endforeach
			                    </div>
			                </div>
	                	</div>
	                </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
@endsection

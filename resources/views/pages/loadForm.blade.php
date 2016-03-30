<!-- for url search -->
<div class="panel-body" id="url_form">
    {{ Form::open(array('url' => 'search/url', 'method' => 'POST', 'class' => 'form-horizontal', 'onSubmit' => 'return validate()')) }}
       <!--@include('pages.searchform', ['labelName' => 'Enter URL', 'fieldName' => 'url', 'holder' => 'google.com'])-->
        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label">{{$labelName}}</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="{{$fieldName}}" placeholder="eg. {{$holder}}" id="searched_input">
                <span class="help-block" id="error"></span>
            </div>
        </div>
        <div class="form-group" id="country">
            {{Form::label('country_label', 'Select Country', array('class' => 'col-md-4 control-label'))}}
            <div class="col-md-6">
                {{Form::select('country', array(
                        'australia' => 'Australia',
                        'china'     => 'China',
                        'india'     => 'India',
                        'us'        => 'US'
                    ),
                    'australia',
                    array('class' => 'form-control')
                )}}
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                {{Form::submit('Click', array('class' => 'btn btn-primary'))}}
            </div>
        </div>
    {{ Form::close() }}
</div>


<!-- for keyword search -->

<div class="panel-body" id="keyword_form">

    {{ Form::open(array('url' => 'search/keyword', 'method' => 'POST', 'class' => 'form-horizontal', 'onSubmit' => 'return validate()')) }}

        @include('pages.searchform', ['labelName' => 'Enter Keyword', 'fieldName' => 'keyword', 'holder' => 'apple'])

    {{ Form::close() }}

</div>

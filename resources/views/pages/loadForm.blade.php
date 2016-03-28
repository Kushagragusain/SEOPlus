<!-- for url search -->
<div class="panel-body" id="url_form">
    {{ Form::open(array('url' => 'search/url', 'method' => 'POST', 'class' => 'form-horizontal', 'onSubmit' => 'return validate()')) }}

       @include('pages.searchform', ['labelName' => 'Enter URL', 'fieldName' => 'url', 'holder' => 'google.com'])

    {{ Form::close() }}
</div>


<!-- for keyword search -->

<div class="panel-body" id="keyword_form">

    {{ Form::open(array('url' => 'search/keyword', 'method' => 'POST', 'class' => 'form-horizontal', 'onSubmit' => 'return validate()')) }}

        @include('pages.searchform', ['labelName' => 'Enter Keyword', 'fieldName' => 'keyword', 'holder' => 'apple'])

    {{ Form::close() }}

</div>

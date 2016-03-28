<div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">{{$labelName}}</label>
    <div class="col-md-6">
        <input type="text" class="form-control" name="{{$fieldName}}" placeholder="eg. {{$holder}}" id="searched_input">
        <span class="help-block" id="error"></span>
    </div>
</div>
<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        {{Form::checkbox('check', 'checked')}}
        {{Form::label('check_label', 'Click to do Country specific search')}}
    </div>
</div>
<div class="form-group" id="country" style="display:none;">
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
        <!--@if ($errors->has('country'))
        <span class="help-block">
            <strong>{{ $errors->first('country') }}</strong>
        </span>
        @endif-->
    </div>
</div>
<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        {{Form::submit('Click', array('class' => 'btn btn-primary'))}}
    </div>
</div>

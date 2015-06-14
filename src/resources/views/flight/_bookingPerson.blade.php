<h2>@lang('soap.booking.' . $type) {!! $index+1 !!}</h2>

<div class="row">
    <div class="col-md-2">
        <div class="form-group @if($errors->has('gender_' . $type . '.' . $index)) has-error @endif">
            {!! Form::label('gender_' . $type, trans('mamorunl-ota::flight.book.fields.gender')) !!}
            {!! Form::select('gender_' . $type . '[' . $index . ']', [0 => trans('mamorunl-ota::flight.mr'), 1 => trans('mamorunl-ota::flight.mrs')], null, ['class' => 'form-control']) !!}
            @if($errors->has('gender' . $type . '.' . $index))
                <div class="help-block">
                    {!! $errors->first('gender_' . $type . '.' . $index) !!}
                </div>
            @endif
        </div>
    </div>

    <div class="col-md-5">
        <div class="form-group @if($errors->has('first_name_' . $type . '.' . $index)) has-error @endif">
            {!! Form::label('first_name_' . $type, trans('mamorunl-ota::flight.book.fields.first_name')) !!}
            {!! Form::text('first_name_' . $type . '[' . $index . ']', null, ['class' => 'form-control', 'autofocus' => true]) !!}
            @if($errors->has('first_name_' . $type . '.' . $index))
                <div class="help-block">
                    {!! $errors->first('first_name_' . $type . '.' . $index) !!}
                </div>
            @endif
        </div>
    </div>

    <div class="col-md-5">
        <div class="form-group @if($errors->has('last_name_' . $type . '.' . $index)) has-error @endif">
            {!! Form::label('last_name_' . $type . '[' . $index . ']', trans('mamorunl-ota::flight.book.fields.last_name')) !!}
            {!! Form::text('last_name_' . $type . '[' . $index . ']', null, ['class' => 'form-control']) !!}
            @if($errors->has('last_name_' . $type . '.' . $index))
                <div class="help-block">
                    {!! $errors->first('last_name_' . $type . '.' . $index) !!}
                </div>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-2">
        <div class="form-group @if($errors->has('area_code_' . $type . '.' . $index)) has-error @endif">
            {!! Form::label('area_code', trans('mamorunl-ota::flight.book.fields.area_code')) !!}
            <div class="input-group">
                <div class="input-group-addon">
                    +
                </div>
                {!! Form::text('area_code_' . $type . '[' . $index . ']', (Input::old('area_code_' . $type . '[' . $index . ']') != null ? Input::old('area_code_' . $type . '[' . $index . ']') : '31'), ['class' => 'form-control']) !!}
            </div>
            @if($errors->has('area_code_' . $type . '.' . $index))
                <div class="help-block">
                    {!! $errors->first('area_code_' . $type . '.' . $index) !!}
                </div>
            @endif
        </div>
    </div>

    <div class="col-md-5">
        <div class="form-group @if($errors->has('city_code_' . $type . '.' . $index)) has-error @endif">
            {!! Form::label('city_code', trans('mamorunl-ota::flight.book.fields.city_code')) !!}
            {!! Form::text('city_code_' . $type . '[' . $index . ']', null, ['class' => 'form-control']) !!}
            @if($errors->has('city_code_' . $type . '.' . $index))
                <div class="help-block">
                    {!! $errors->first('city_code_' . $type . '.' . $index) !!}
                </div>
            @endif
        </div>
    </div>

    <div class="col-md-5">
        <div class="form-group @if($errors->has('phone_' . $type . '.' . $index)) has-error @endif">
            {!! Form::label('phone', trans('mamorunl-ota::flight.book.fields.phone')) !!}
            {!! Form::text('phone_' . $type . '[' . $index . ']', null, ['class' => 'form-control']) !!}
            @if($errors->has('phone_' . $type . '.' . $index))
                <div class="help-block">
                    {!! $errors->first('phone_' . $type . '.' . $index) !!}
                </div>
            @endif
        </div>
    </div>
</div>


<div class="form-group @if($errors->has('emailaddress_' . $type . '.' . $index)) has-error @endif">
    {!! Form::label('emailaddress', trans('mamorunl-ota::flight.book.fields.emailaddress')) !!}
    {!! Form::text('emailaddress_' . $type . '[' . $index . ']', null, ['class' => 'form-control']) !!}
    @if($errors->has('emailaddress_' . $type . '.' . $index))
        <div class="help-block">
            {!! $errors->first('emailaddress_' . $type . '.' . $index) !!}
        </div>
    @endif
</div>

<div class="form-group @if($errors->has('dateofbirth_' . $type . '.' . $index)) has-error @endif">
    {!! Form::label('dateofbirth', trans('mamorunl-ota::flight.book.fields.dateofbirth')) !!}
    {!! Form::text('dateofbirth_' . $type . '[' . $index . ']', null, ['class' => 'form-control']) !!}
    @if($errors->has('dateofbirth_' . $type . '.' . $index))
        <div class="help-block">
            {!! $errors->first('dateofbirth_' . $type . '.' . $index) !!}
        </div>
    @endif
</div>
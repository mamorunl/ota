{!! Form::open(['method' => 'post', 'route' => 'ota.flight.search']) !!}
<div class="form-group{{ $errors->has('airport_from') ? ' has-error' : '' }}">
    {!! Form::label('airport_from', trans('mamorunl-ota::flight.fields.airport_from')) !!}
    {!! Form::text('airport_from', null, ['class' => 'form-control']) !!}
    @if($errors->has('airport_from'))
        <div class="help-block">
            {!! $errors->first('airport_from') !!}
        </div>
    @endif
</div>

<div class="form-group{{ $errors->has('airport_to') ? ' has-error' : '' }}">
    {!! Form::label('airport_to', trans('mamorunl-ota::flight.fields.airport_to')) !!}
    {!! Form::text('airport_to', null, ['class' => 'form-control']) !!}
    @if($errors->has('airport_to'))
        <div class="help-block">
            {!! $errors->first('airport_to') !!}
        </div>
    @endif
</div>

<div class="form-group{{ $errors->has('date_arrival') ? ' has-error' : '' }}">
    {!! Form::label('date_arrival', trans('mamorunl-ota::flight.fields.date_arrival')) !!}
    {!! Form::text('date_arrival', null, ['class' => 'form-control']) !!}
    @if($errors->has('date_arrival'))
        <div class="help-block">
            {!! $errors->first('date_arrival') !!}
        </div>
    @endif
</div>

<div class="form-group{{ $errors->has('date_return') ? ' has-error' : '' }}">
    {!! Form::label('date_return', trans('mamorunl-ota::flight.fields.date_return')) !!}
    {!! Form::text('date_return', null, ['class' => 'form-control']) !!}
    @if($errors->has('date_return'))
        <div class="help-block">
            {!! $errors->first('date_return') !!}
        </div>
    @endif
</div>

<div class="form-group{{ $errors->has('num_adults') ? ' has-error' : '' }}">
    {!! Form::label('num_adults', trans('mamorunl-ota::flight.fields.num_adults')) !!}
    {!! Form::text('num_adults', null, ['class' => 'form-control']) !!}
    @if($errors->has('num_adults'))
        <div class="help-block">
            {!! $errors->first('num_adults') !!}
        </div>
    @endif
</div>

<div class="form-group{{ $errors->has('num_children') ? ' has-error' : '' }}">
    {!! Form::label('num_children', trans('mamorunl-ota::flight.fields.num_children')) !!}
    {!! Form::text('num_children', null, ['class' => 'form-control']) !!}
    @if($errors->has('num_children'))
        <div class="help-block">
            {!! $errors->first('num_children') !!}
        </div>
    @endif
</div>

<div class="form-group{{ $errors->has('num_infants') ? ' has-error' : '' }}">
    {!! Form::label('num_infants', trans('mamorunl-ota::flight.fields.num_infants')) !!}
    {!! Form::text('num_infants', null, ['class' => 'form-control']) !!}
    @if($errors->has('num_infants'))
        <div class="help-block">
            {!! $errors->first('num_infants') !!}
        </div>
    @endif
</div>

<div class="form-group{{ $errors->has('flight_type') ? ' has-error' : '' }}">
    {!! Form::label('flight_type', trans('mamorunl-ota::flight.fields.flight_type')) !!}
    {!! Form::text('flight_type', null, ['class' => 'form-control']) !!}
    @if($errors->has('flight_type'))
        <div class="help-block">
            {!! $errors->first('flight_type') !!}
        </div>
    @endif
</div>

<button type="submit" class="btn btn-primary">@lang('mamorunl-ota::buttons.search')</button>
{!! Form::close() !!}
{!! Form::open(['method' => 'post', 'route' => [
<div class="row">
    <div class="col-md-8">
        <h2>@lang('mamorunl-ota::flight.book.person_data')</h2>
        @for($i = 0; $i < $person_data['num_adults']; $i++)
            <h3>@lang('mamorunl-ota::flight.book.adult') {{ $i+1 }}</h3>
            @include('mamorunl-ota::flight._bookingPerson', ['type' => 'adult', 'index' => $i])
        @endfor
    </div>

    <div class="col-md-4">
        <h2>@lang('mamorunl-ota::flight.book.flight_information')</h2>
        <div class="row">
            <div class="col-md-8">
                @lang('mamorunl-ota::flight.fields.flight_number')
            </div>
            <div class="col-md-4">
                {{ $flight_data['airline_code'] }}{{ $flight_data['flight_number'] }}
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                @lang('mamorunl-ota::flight.fields.airport_from')
            </div>
            <div class="col-md-4">
                {{ $flight_data['airport_from'] }}
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                @lang('mamorunl-ota::flight.fields.airport_to')
            </div>
            <div class="col-md-4">
                {{ $flight_data['airport_to'] }}
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                @lang('mamorunl-ota::flight.fields.date_departure')
            </div>
            <div class="col-md-4">
                {{ $flight_data['date_departure'] }}
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                @lang('mamorunl-ota::flight.fields.date_arrival')
            </div>
            <div class="col-md-4">
                {{ $flight_data['date_arrival'] }}
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                @lang('mamorunl-ota::flight.fields.row')
            </div>
            <div class="col-md-4">
                {{ $flight_data['row_letter'] }}
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                @lang('mamorunl-ota::flight.book.total_price')
            </div>

            <div class="col-md-4">
                &euro; {{ number_format($flight_data['price'], 2, ",", ".") }}
            </div>
        </div>
    </div>
</div>
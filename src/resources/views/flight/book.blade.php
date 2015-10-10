{!! Form::open(['method' => 'post', 'route' => ['ota.flight.handle-booking', 'd' => $d, 't' => $t]]) !!}
<div class="row">
    <div class="col-md-8">
        <h2>@lang('mamorunl-ota::flight.book.person_data')</h2>
        @for($i = 0; $i < $person_data['num_adults']; $i++)
            <h3>@lang('mamorunl-ota::flight.book.adult') {{ $i+1 }}</h3>
            @include('mamorunl-ota::flight._bookingPerson', ['type' => 'adult', 'index' => $i])
        @endfor

        @for($i = 0; $i < $person_data['num_children']; $i++)
            <h3>@lang('mamorunl-ota::flight.book.child') {{ $i+1 }}</h3>
            @include('mamorunl-ota::flight._bookingPerson', ['type' => 'child', 'index' => $i])
        @endfor

        @for($i = 0; $i < $person_data['num_infants']; $i++)
            <h3>@lang('mamorunl-ota::flight.book.infant') {{ $i+1 }}</h3>
            @include('mamorunl-ota::flight._bookingPerson', ['type' => 'infant', 'index' => $i])
        @endfor
    </div>

    <div class="col-md-4">
        <h2>@lang('mamorunl-ota::flight.book.flight_information')</h2>
        @foreach($flight_data as $id => $flight)
            <h2>
                <i class="fa fa-arrow-right"></i> {{ trans('mamorunl-ota::flight.display.flight_information') }} {{ $flight['airline_code'] }} {{ $flight['flight_number'] }}
                : {{ $flight['date_departure'] }}</h2>
            <h3>{{ trans('soap.availability.flight_info') }}</h3>
            <div class="row">
                <div class="col-md-8">
                    @lang('mamorunl-ota::flight.fields.flight_number')
                </div>
                <div class="col-md-4">
                    {{ $flight['airline_code'] }}{{ $flight['flight_number'] }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    @lang('mamorunl-ota::flight.fields.airport_from')
                </div>
                <div class="col-md-4">
                    {{ $flight['airport_from'] }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    @lang('mamorunl-ota::flight.fields.airport_to')
                </div>
                <div class="col-md-4">
                    {{ $flight['airport_to'] }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    @lang('mamorunl-ota::flight.fields.date_departure')
                </div>
                <div class="col-md-4">
                    {{ $flight['date_departure'] }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    @lang('mamorunl-ota::flight.fields.date_arrival')
                </div>
                <div class="col-md-4">
                    {{ $flight['date_arrival'] }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    @lang('mamorunl-ota::flight.fields.row')
                </div>
                <div class="col-md-4">
                    {{ $row_letter_t['row_letter'] }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    @lang('mamorunl-ota::flight.book.total_price')
                </div>

                <div class="col-md-4">
                    &euro; {{ number_format($row_letter_t['price'], 2, ",", ".") }}
                </div>
            </div>
        @endforeach
        {{--<div class="row">
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
        </div>--}}
    </div>
</div>

<button type="submit" class="btn btn-primary">@lang('mamorunl-ota::flight.buttons.book')</button>
{!! Form::close() !!}
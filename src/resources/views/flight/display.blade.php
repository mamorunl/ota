@foreach($flights as $flight)
    <h2>{{ trans('mamorunl-ota::flight.display.flight_information') }} {{ $flight['airline_code'] }} {{ $flight['flight_number'] }}: {{ $flight['date_departure'] }}</h2>
    <div class="row">
        <div class="col-md-6">
            <h3>{{ trans('soap.availability.flight_info') }}</h3>
            <table class="table">
                <tr>
                    <td class="col-md-6">{{ trans('soap.availability.airport_from') }}</td>
                    <td class="col-md-6">{{ $flight['airport_from'] }}</td>
                </tr>
                <tr>
                    <td>{{ trans('soap.availability.airport_to') }}</td>
                    <td>{{ $flight['airport_to'] }}</td>
                </tr>
                <tr>
                    <td>{{ trans('soap.availability.flight_number') }}</td>
                    <td>{{ $flight['airline_code'] }} {{ $flight['flight_number'] }}</td>
                </tr>
                {{--<tr>
                    <td>{{ trans('soap.availability.departure_date_time') }}</td>
                    <td>{{ date('d M Y H:i', $flight->departureDateTime->timestamp) }}</td>
                </tr>
                <tr>
                    <td>{{ trans('soap.availability.arrival_date_time') }}</td>
                    <td>{{ date('d M Y H:i', $flight->arrivalDateTime->timestamp) }}</td>
                </tr>--}}
            </table>
        </div>
    </div>
@endforeach
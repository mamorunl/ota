{!! Form::open(['route' => ['ota.flight.book', 'd' => $d, 't' => $t]]) !!}
@foreach($flights as $id => $flight)
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

        <div class="col-md-6">
            <span class="ajax-price-list" data-direction="t" data-flight_number="{{ $flight['flight_number'] }}" data-airport_from="{{ $flight['airport_from'] }}" data-airport_to="{{ $flight['airport_to'] }}"
                  data-departure_dt="{{ $flight['date_departure'] }}" data-row_data="{{ serialize($flight['seats_free']) }}">&&<br/>Loading prices...</span>
        </div>
    </div>
@endforeach
<button type="submit" id="btn-submit" class="btn btn-primary btn-lg"><i class="fa fa-plane"></i> Book this flight</button>
{!! Form::close() !!}

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('#btn-submit').click(function(e) {
            if($('input[name=row_letter_t]:checked').val() === undefined) {
                e.preventDefault();
                alert('Oops! You haven\'t selected a flight yet!');
            }
        });

        $('.ajax-price-list').each(function() {
            var $price_list = $(this);
            $.post('{{ route('ota.flight.load_price') }}', {
                'flight_number': $price_list.data('flight_number'),
                'airport_from': $price_list.data('airport_from'),
                'airport_to': $price_list.data('airport_to'),
                'departure_dt': $price_list.data('departure_dt'),
                'row_data': $price_list.data('row_data'),
                't': '{{ $t }}',
                '_token': "{{ csrf_token() }}"
            }, function(data) {
                html = "";
                for(var key in data) {
                    if(data.hasOwnProperty(key)) {
                        html += '<div class="radio">' +
                                '<label>' +
                                '<input type="radio" name="row_letter_' + $price_list.data('direction') + '" value="' + data[key]['encoded'] + '">' +
                                '<span>' + key + ': ' + data[key]['price'] + '</span>' +
                                '</label>' +
                                '</div>';
                    }
                }
                $price_list.html(html);
            }, "json");
        });
    });
</script>
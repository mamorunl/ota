Dear {{ ($adults[0]->gender == 1) ? trans('mamorunl-ota::flight.mr') : trans('mamorunl-ota::flight.mrs') }} {{ $adults[0]->last_name }},<br>
<br>
Thank you for booking with HolidayLaunch!<br>
<br>
Your booking details are as follows:<br>

<h1>Flight information</h1>
<table>
    <tr>
        <td>You are flying from</td>
        <td>{{ $booking->airport_from }} at {{ $booking->date_departure }}</td>
    </tr>
    <tr>
        <td>You are arriving at</td>
        <td>{{ $booking->airport_to }} at {{ $booking->date_arrival }}</td>
    </tr>
    <tr>
        <td>Your flight number is</td>
        <td>{{ $booking->airline_code }}{{ $booking->flight_number }}</td>
    </tr>
    <tr>
        <td>You are sitting in row</td>
        <td>{{ $booking->row_letter }}</td>
    </tr>
    <tr>
        <td>The total price is</td>
        <td>&euro; {{ number_format($flight_data['price'], 2, ",", ".") }}</td>
    </tr>
</table>

<h1>The people you have booked tickets for</h1>
<h2>Adults</h2>
@foreach($adults as $person_data)
    @include('mamorunl-ota::flight.emails._personPart', ['type' => 'adult', 'data' => $person_data])
@endforeach

@if(count($children) > 0)
    <h2>Children</h2>
    @foreach($children as $person_data)
        @include('mamorunl-ota::flight.emails._personPart', ['type' => 'child', 'data' => $person_data])
    @endforeach
@endif

@if(count($infants) > 0)
    <h2>Infants</h2>
    @foreach($infants as $person_data)
        @include('mamorunl-ota::flight.emails._personPart', ['type' => 'infant', 'data' => $person_data])
    @endforeach
@endif
<br>
<br>
Please transfer the money by bank to NL26 INGB 099999999 in name of HOLIDAYLAUNCH BV, Enschede The Netherlands. In your description, please note the following number: {{ $booking->created_at->format('U') . "-" . $booking->id . "-" . $booking->flight_number }}<br>
<br>
If you would like to change your reservation or cancel, please contact us by email or phone.<br>
<br>
Kind regards,<br>
HolidayLaunch
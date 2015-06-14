Dear {{ ($adults[0]->gender == 1) ? trans('mamorunl-ota::flight.mr') : trans('mamorunl-ota::flight.mrs') }} {{ $adults[0]->last_name }},<br>
<br>
Thank you for booking with HolidayLaunch!<br>
<br>
Your booking details are as follows:<br>
<h2>Adults</h2>
@foreach($adults as $adult)
    <table>
        <tr>
            <td>Full name</td>
            <td>{{ ($adult->gender == 0) ? trans('mamorunl-ota::flight.mr') : trans('mamorunl-ota::flight.mrs') }} {{ $adult->first_name }} {{ $adult->last_name }}</td>
        </tr>
        <tr>
            <td>Phone number</td>
            <td>{{ $adult->area_code }}{{ $adult->city_code }} {{ $adult->phone }}</td>
        </tr>
        <tr>
            <td>Email address</td>
            <td>{{ $adult->email }}</td>
        </tr>
        <tr>
            <td>Date of birth</td>
            <td>{{ $adult->date_of_birth }}</td>
        </tr>
    </table>
@endforeach

Your total price is &euro; 5<br>
<br>
Please transfer the money by bank to NL26 INGB 099999999 in name of HOLIDAYLAUNCH BV, Enschede The Netherlands. In your description, please note the following number: {{ $booking->created_at->format('U') . "-" . $booking->id . "-" . $booking->flight_number }}<br>
<br>
If you would like to change your reservation or cancel, please contact us by email or phone.<br>
<br>
Kind regards,<br>
HolidayLaunch
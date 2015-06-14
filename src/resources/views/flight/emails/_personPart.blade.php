<table>
    <tr>
        <td>Full name</td>
        <td>{{ ($data->gender == 1) ? trans('mamorunl-ota::flight.mr') : trans('mamorunl-ota::flight.mrs') }} {{ $data->first_name }} {{ $data->last_name }}</td>
    </tr>
    <tr>
        <td>Phone number</td>
        <td>{{ $data->area_code }}{{ $data->city_code }} {{ $data->phone }}</td>
    </tr>
    <tr>
        <td>Email address</td>
        <td>{{ $data->email }}</td>
    </tr>
    <tr>
        <td>Date of birth</td>
        <td>{{ $data->date_of_birth }}</td>
    </tr>
</table>
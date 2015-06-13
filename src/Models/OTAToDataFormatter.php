<?php
/**
 * Created by Bas Hepping <info@mamoru.nl>.
 * Date: 13-6-2015
 * Time: 21:16
 */

namespace mamorunl\OTA\Models;


use Carbon\Carbon;

class OTAToDataFormatter
{
    public function forAvailability($data)
    {
        $source = $data->OriginDestinationOptions->OriginDestinationOption->FlightSegment;

        $data = [
            'airport_from'          => $source->DepartureAirport->LocationCode,
            'airport_to'            => $source->ArrivalAirport->LocationCode,
            'date_arrival'          => Carbon::createFromFormat('Y-m-d H:i:s.u', $source->ArrivalDateTime),
            'date_departure'        => Carbon::createFromFormat('Y-m-d H:i:s.u', $source->DepartureDateTime),
            'flight_number'         => $source->FlightNumber,
            'airline_code'          => $source->MarkettingAirline->CompanyShortName,
            'script_execution_date' => time()
        ];

        foreach ($source->BookingClassAvail as $row_data) {
            $data['seats_free'][$row_data->ResBookDesigCode] = $row_data->ResBookDesigQuantity;
        }

        return $data;
    }
}
<?php
/**
 * Created by Bas Hepping <info@mamoru.nl>.
 * Date: 13-6-2015
 * Time: 21:16
 */

namespace mamorunl\OTA\Models;


use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class OTAToDataFormatter
{
    public function forAvailability($data)
    {
        $source = $data->OriginDestinationOptions->OriginDestinationOption->FlightSegment;
        $data = [];

        $data[0] = [
            'airport_from'          => $source->DepartureAirport->LocationCode,
            'airport_to'            => $source->ArrivalAirport->LocationCode,
            'date_arrival'          => Carbon::createFromFormat('Y-m-d H:i:s.u', $source->ArrivalDateTime)
                ->toDateTimeString(),
            'date_departure'        => Carbon::createFromFormat('Y-m-d H:i:s.u', $source->DepartureDateTime)
                ->toDateTimeString(),
            'flight_number'         => $source->FlightNumber,
            'airline_code'          => $source->MarkettingAirline->CompanyShortName,
            'script_execution_date' => time()
        ];

        foreach ($source->BookingClassAvail as $row_data) {
            $data[0]['seats_free'][$row_data->ResBookDesigCode] = $row_data->ResBookDesigQuantity;
        }

        return $this->encryptFromURL($data);
    }

    public function forFareDisplay($data, $flight_data)
    {
        $fare = [];
        foreach ($data->FareDisplayInfos->FareDisplayInfo as $prices_from_ota) {
            foreach ($flight_data['seats_free'] as $row => $number_free) {
                if ($row == $prices_from_ota->ResBookDesigCode && $number_free > 0) {
                    $fare[$row][$prices_from_ota->PricingInfo->PassengerTypeCode] = $prices_from_ota->PricingInfo->TotalFare->Amount;
                }
            }
        }

        return $fare;
    }

    public function encryptFromURL($data)
    {
        $flight_data = json_encode($data);
        $encrypted_data = urlencode(base64_encode(mcrypt_encrypt(MCRYPT_BLOWFISH, Config::get('app.key'), $flight_data,
            MCRYPT_MODE_ECB)));

        return $encrypted_data;
    }

    public function decryptFromURL($data)
    {
        $encrypted_data = base64_decode(urldecode($data));
        $decrypted_data = json_decode(mcrypt_decrypt(MCRYPT_BLOWFISH, Config::get('app.key'), $encrypted_data,
            MCRYPT_MODE_ECB),
            true);

        return $decrypted_data;
    }
}
<?php
/**
 * Created by Bas Hepping <info@mamoru.nl>.
 * Date: 13-6-2015
 * Time: 20:55
 */

namespace mamorunl\OTA\Models;


use mamorunl\OTA\Facades\DataToOTAFormatter as DataOTAFormatter;
use mamorunl\OTA\Facades\OTAToDataFormatter as Formatter;

class OTAHandler
{
    public function oneWayFlight(OTAConnection $connection, $data)
    {
        $client = $connection->getConnection();

        return Formatter::encrypt(Formatter::forAvailability($client->Availability($data)));
    }

    public function returnFlight($data)
    {
        $connection = new OTAConnection('onur');

        $client = $connection->getConnection();

        $flight_to_string = DataOTAFormatter::forAvailability($data['date_arrival'], $data['airport_from'], $data['airport_to'], $data['traveller_info']);

        $flight_from_string = DataOTAFormatter::forAvailability($data['date_return'], $data['airport_to'], $data['airport_from'], $data['traveller_info']);

        $flight_to = Formatter::forAvailability($client->Availability($flight_to_string));

        $flight_from = Formatter::forAvailability($client->Availability($flight_from_string));

        $flight_information = [
            'flight_destination' => $flight_to,
            'flight_home' => $flight_from
        ];

        return Formatter::encrypt($flight_information);
    }

    public function fareDisplay(OTAConnection $connection, $data)
    {
        $client = $connection->getConnection();

        return Formatter::forFareDisplay($client->FareDisplay($data));
    }

    public function booking(OTAConnection $connection, $data)
    {
        $client = $connection->getConnection();

        try {
            Formatter::forBooking($client->Booking($data));
        } catch(\Exception $e) {
            echo $e->getMessage();
            dd($client->__getLastRequest());
        }
    }
}
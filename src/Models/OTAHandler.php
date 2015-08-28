<?php
/**
 * Created by Bas Hepping <info@mamoru.nl>.
 * Date: 13-6-2015
 * Time: 20:55
 */

namespace mamorunl\OTA\Models;


use mamorunl\OTA\Facades\OTAToDataFormatter as Formatter;

class OTAHandler
{
    public function availability(OTAConnection $connection, $data)
    {
        $client = $connection->getConnection();

        return Formatter::forAvailability($client->Availability($data));
    }

    public function fareDisplay(OTAConnection $connection, $data, $flight_data)
    {
        $client = $connection->getConnection();

        return Formatter::forFareDisplay($client->FareDisplay($data), $flight_data);
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
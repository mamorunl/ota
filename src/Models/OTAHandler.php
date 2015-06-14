<?php
/**
 * Created by Bas Hepping <info@mamoru.nl>.
 * Date: 13-6-2015
 * Time: 20:55
 */

namespace mamorunl\OTA\Models;


use mamorunl\OTA\Facades\OTAToDataFormatter;

class OTAHandler
{
    public function availability(OTAConnection $connection, $data)
    {
        $client = $connection->getConnection();

        return OTAToDataFormatter::forAvailability($client->Availability($data));
    }

    public function fareDisplay(OTAConnection $connection, $data, $flight_data)
    {
        $client = $connection->getConnection();

        return OTAToDataFormatter::forFareDisplay($client->FareDisplay($data), $flight_data);
    }
}
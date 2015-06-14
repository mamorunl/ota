<?php
/**
 * Created by Bas Hepping <info@mamoru.nl>.
 * Date: 13-6-2015
 * Time: 21:06
 */

namespace mamorunl\OTA\Models;


use Carbon\Carbon;
use stdClass;

class DataToOTAFormatter
{
    public function forAvailability($data)
    {
        $request = [
            'POS'                          => [
                'Source' => [
                    'RequestorID'    => 1,
                    'BookingChannel' => 1
                ]
            ],
            'OriginDestinationInformation' => [
                'DepartureDateTime'   => $data['date_arrival'],
                'OriginLocation'      => [
                    '_'            => '',
                    'LocationCode' => $data['airport_from']
                ],
                'DestinationLocation' => [
                    '_'            => '',
                    'LocationCode' => $data['airport_to']
                ]
            ],
            'TravelPreferences'            => [
                'FlightTypePref'    => [
                    '_'           => '',
                    'PreferLevel' => 1,
                    'FlightType'  => 'D'
                ],
                'EquipPref'         => [
                    '_'            => '',
                    'AirEquipType' => '756'
                ],
                'CabinPref'         => [
                    '_'           => '',
                    'PreferLevel' => 'T',
                    'Cabin'       => 'Y'
                ],
                'TicketDistribPref' => [
                    '_'           => '',
                    'PreferLevel' => 1,
                    'DistribType' => 1
                ],
                'BookingClassPref'  => [
                    '_'                => '',
                    'ResBookDesigCode' => 2
                ]
            ]
        ];

        if (is_array($data['traveller_info']) && count($data['traveller_info']) > 0) {
            $request['TravelerInfoSummary']['AirTravelerAvail'] = [];
            foreach ($data['traveller_info'] as $person) {
                $personObject = new \StdClass;
                $personObject->Quantity = $person['quantity'];
                $personObject->Code = $person['code'];
                $request['TravelerInfoSummary']['AirTravelerAvail']['PassengerTypeQuantity'][] = $personObject;
            }
            $request['TravelerInfoSummary']['AirTravelerAvail']['temp'] = "String";
        }

        return $request;
    }

    public function forFareDisplay($flight_data)
    {
        $request['POS'] = [];
        $newClass = new StdClass;
        $newClass->requestorID = [
            "_" => '',
            "id" => 1,
            "type" => 1,
            "url" => 1
        ];
        $newClass->BookingChannel = [
            "_" => '',
            "Primary" => 1,
            "Type" => 1
        ];
        $request['POS']['Source'] = [
            'isoCurrency' => 'EUR',
            'isoCountry' => 'TR',
            'RequestorID' => [
                "_" => '',
                'id' => 1,
                'type' => 1,
                'url' => 1
            ],
            'BookingChannel' => [
                "_" => '',
                'Primary' => 1,
                'Type' => 1
            ]
        ];

        $date_departure = Carbon::createFromFormat('Y-m-d H:i:s', $flight_data['date_departure'])->toDateString();
        $request['OriginDestinationInformation'] = [
            "DepartureDateTime" => $date_departure,
            "OriginLocation" => [
                "_" => '',
                "LocationCode" => $flight_data['airport_from']
            ],
            "DestinationLocation" => [
                "_" => "",
                "LocationCode" => $flight_data['airport_to']
            ]
        ];

        $request['SpecificFlightInfo'] = [
            "FlightNumber" => $flight_data['flight_number'],
            "BookingClassPref" =>
                [
                    "_" => "",
                    "ResBookDesigCode" => "1"
                ]
        ];

        return $request;
    }
}
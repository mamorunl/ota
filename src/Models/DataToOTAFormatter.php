<?php
/**
 * Created by Bas Hepping <info@mamoru.nl>.
 * Date: 13-6-2015
 * Time: 21:06
 */

namespace mamorunl\OTA\Models;


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
}
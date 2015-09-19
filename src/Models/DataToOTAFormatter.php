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
    public function forAvailability($date_arrival, $airport_from, $airport_to, array $traveler_info)
    {
        $request = [
            'POS'                          => [
                'Source' => [
                    'RequestorID'    => 1,
                    'BookingChannel' => 1
                ]
            ],
            'OriginDestinationInformation' => [
                'DepartureDateTime'   => $date_arrival,
                'OriginLocation'      => [
                    '_'            => '',
                    'LocationCode' => $airport_from
                ],
                'DestinationLocation' => [
                    '_'            => '',
                    'LocationCode' => $airport_to
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

        if (is_array($traveler_info) && count($traveler_info) > 0) {
            $request['TravelerInfoSummary']['AirTravelerAvail'] = [];
            foreach ($traveler_info as $person) {
                $personObject = new \StdClass;
                $personObject->Quantity = $person['quantity'];
                $personObject->Code = $person['code'];
                $request['TravelerInfoSummary']['AirTravelerAvail']['PassengerTypeQuantity'][] = $personObject;
            }
            $request['TravelerInfoSummary']['AirTravelerAvail']['temp'] = "String";
        }

        return $request;
    }

    public function forFareDisplay($date_departure, $airport_from, $airport_to, $flight_number)
    {
        $request['POS'] = [];
        $newClass = new StdClass;
        $newClass->requestorID = [
            "_"    => '',
            "id"   => 1,
            "type" => 1,
            "url"  => 1
        ];
        $newClass->BookingChannel = [
            "_"       => '',
            "Primary" => 1,
            "Type"    => 1
        ];
        $request['POS']['Source'] = [
            'isoCurrency'    => 'EUR',
            'isoCountry'     => 'TR',
            'RequestorID'    => [
                "_"    => '',
                'id'   => 1,
                'type' => 1,
                'url'  => 1
            ],
            'BookingChannel' => [
                "_"       => '',
                'Primary' => 1,
                'Type'    => 1
            ]
        ];

        $date_departure = Carbon::createFromFormat('Y-m-d H:i:s', $date_departure)
            ->toDateString();
        $request['OriginDestinationInformation'] = [
            "DepartureDateTime"   => $date_departure,
            "OriginLocation"      => [
                "_"            => '',
                "LocationCode" => $airport_from
            ],
            "DestinationLocation" => [
                "_"            => "",
                "LocationCode" => $airport_to
            ]
        ];

        $request['SpecificFlightInfo'] = [
            "FlightNumber"     => $flight_number,
            "BookingClassPref" =>
                [
                    "_"                => "",
                    "ResBookDesigCode" => "1"
                ]
        ];

        return $request;
    }

    public function forBooking()
    {
        $request['POS'] = [];
        $request['POS']['Source'] = [
            'isoCurrency'    => 'EUR',
            'isoCountry'     => 'TR',
            'agentSine'      => 'BSIA1234PM',
            'RequestorID'    => [
                "_"    => '',
                'id'   => 1,
                'type' => 1,
                'url'  => 1
            ],
            'BookingChannel' => [
                "_"       => '',
                'Primary' => 1,
                'Type'    => 1
            ]
        ];

        $request['AirItinerary'] = [];
        $request['AirItinerary']['DirectionInd'] = 1;
        $request['AirItinerary']['OriginDestinationOptions'] = [];
        $flightSegment = [
            'FlightSegment' => [
                //'_'                 => [
                'DepartureAirport'  => [
                    '_'            => '',
                    'LocationCode' => 'AMS' //
                ],
                'ArrivalAirport'    => [
                    '_'            => '',
                    'LocationCode' => 'IST' //
                ],
                'Equipment'         => [
                    '_'             => '',
                    'ChangeofGauge' => 'N',
                    'AirEquipType'  => 6
                ],
                'MarkettingAirline' => [
                    '_'                => [
                        'Meal' => 'String'
                    ],
                    'CompanyShortName' => '8Q'
                ],
                'MarketingCabin'    => [
                    '_'         => '',
                    'CabinType' => 'Y',
                    'RPH'       => 1
                ],
                'BookingClassAvail' => [
                    '_'                    => '',
                    'ResBookDesigCode'     => 'D', //
                    'RPH'                  => 1,
                    'ResBookDesigQuantity' => 9 //
                ],
                'comment'           => '',
                //],
                'DepartureDateTime' => '2015-08-25 14:55:00.0', //
                'ArrivalDateTime'   => '2015-08-25 19:25:00.0', //
                'OnTimeRate'        => 1,
                'JourneyDuration'   => 1,
                'ResBookDesigID'    => 633552, //
                'ResBookDesigCode'  => 'DINTEFLX', //
                'Ticket'            => 1,
                'StopQuantity'      => 0,
                'FlightNumber'      => 372, //
            ]
        ];
        $request['AirItinerary']['OriginDestinationOptions']['OriginDestinationOption'] = $flightSegment;

        $request['TravelerInfo'] = [
            'AirTraveler'       => [
                'PassengerTypeCode' => 'ADT',
                'TicketNumber'      => 1225, //?
                'ProfileRef'        => [
                    'UniqueID' => [
                        '_'        => '',
                        'Type'     => 1,
                        'Instance' => 1,
                        'URL'      => 1,
                        'ID'       => 1
                    ]
                ],
                'PersonName'        => [ //
                    'NamePrefix' => 'Mr',
                    'GivenName'  => 'John',
                    'Surname'    => 'Doe',
                    'NameTitle'  => ''
                ],
                'Telephone'         => [
                    '_'            => '',
                    'AreaCityCode' => '+31 6',
                    'PhoneNumber'  => '12345678'
                ],
                'Email'             => 'info@example.com',
                'Document'          => [
                    'DocHolderName'     => '',
                    'BirthDate'         => '1970-01-01', //
                    'DocID'             => '102938455', //
                    'Gender'            => 'M', //
                    'ExpireDate'        => '1',
                    'EffectiveDate'     => '1',
                    'DocType'           => '1',
                    'DocIssueAuthority' => '1',
                    'DocIssueLocation'  => '1'
                ]
            ],
            'SpecialReqDetails' => [
                'SeatRequests'           => [
                    'item' => [
                        '_'                        => '',
                        'FlightRefNumberRPHList'   => 1,
                        'SeatNumber'               => 1,
                        'TravelerRefNumberRPHList' => 1
                    ]
                ],
                'SpecialServiceRequests' => [
                    'SpecialServiceRequest' => [
                        'Airline'                => 'HOLIDAYXML',
                        'text'                   => '4000002434',
                        'SSRCode'                => 'BILL',
                        'FlightRefNumberRPHList' => 1
                    ]
                ]
            ]
        ];

        $pre_request = $request + [
                'ExtTransactionID' => time(),
                'SequenceNmbr'     => 1,
                'TimeStamp'        => 1,
                'Ticketing' => [
                    '_' => '',
                    'TicketType' => 1
                ]
            ];

//        dd($pre_request);

        return $pre_request;
    }
}
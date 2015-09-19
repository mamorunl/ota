<?php
/**
 * Created by Bas Hepping <info@mamoru.nl>.
 * Date: 13-6-2015
 * Time: 22:13
 */

namespace mamorunl\OTA\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use mamorunl\OTA\Facades\DataToOTAFormatter;
use mamorunl\OTA\Facades\OTA;
use mamorunl\OTA\Facades\OTAToDataFormatter;
use mamorunl\OTA\Models\OTAConnection;

class OTAAjaxFlightController extends Controller
{
    /**
     * Display the price list for this flight
     *
     * @param Request $request
     */
    public function priceListPerRow(Request $request)
    {
        $ota_connection = new OTAConnection('onur');

        $date_departure = $request->get('departure_dt');
        $airport_from = $request->get('airport_from');
        $airport_to = $request->get('airport_to');
        $flight_number = $request->get('flight_number');

        $returned_data = OTA::fareDisplay($ota_connection, DataToOTAFormatter::forFareDisplay($date_departure, $airport_from, $airport_to, $flight_number));

        $seats_free = unserialize($request->get('row_data'));

        $person_data = OTAToDataFormatter::decrypt($request->get('t'));

        foreach ($seats_free as $letter => $number_of_seats_free) {
            if($number_of_seats_free == 0) {
                unset($returned_data[$letter]);
            }
        }


        $price_list = $this->calculateTotalPrice($returned_data, $person_data);

        echo json_encode($price_list);
        die();
//        $decrypted_data = OTAToDataFormatter::decrypt($request->get('d'));
//        dd($decrypted_data);
//        $flight_data = $decrypted_data[(int)$request->get('flight_id')];
//        $person_data = OTAToDataFormatter::decrypt($request->get('t'));
//        $rows = $flight_data['seats_free'];
//
//        // @TODO: Make dynamic
//
//        $price_list_from_ota = OTA::fareDisplay($ota_connection, DataToOTAFormatter::forFareDisplay($date_departure, $airport_from, $airport_to, $flight_number), $flight_data);
//        $price_list = $this->calculateTotalPrice($price_list_from_ota, $person_data);
//        asort($price_list, SORT_NUMERIC);
//
//        foreach ($price_list as $row => $price) {
//            $seats_free = $rows[$row];
//
//            $new_data = OTAToDataFormatter::encrypt($flight_data + ['price' => $price, 'row_letter' => $row]);
//            echo "<div>" . $row . ": " . $seats_free . " free - &euro; " . $price . ".00 <a href=\"" . route('ota.flight.book',
//                    ['d' => $new_data, 't' => $request->get('t')]) . "\">BOOK NOW</a></div>";
//        }
    }

    private function calculateTotalPrice($price_list, $person_data)
    {
        $prices_per_row = [];
        foreach($price_list as $row_letter => $prices_per_person_type) {
            foreach($prices_per_person_type as $type_identifier => $price_per_type) {
                if(!isset($prices_per_row[$row_letter])) {
                    $prices_per_row[$row_letter] = 0;
                }
                switch($type_identifier) {
                    case "ADT": $prices_per_row[$row_letter] += ($price_per_type*$person_data['num_adults']);
                        break;
                    case "CHD": $prices_per_row[$row_letter] += ($price_per_type*$person_data['num_children']);
                        break;
                    case "INF": $prices_per_row[$row_letter] += ($price_per_type*$person_data['num_infants']);
                        break;
                }
            }
        }
        return $prices_per_row;
    }
}
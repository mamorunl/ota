<?php
/**
 * Created by Bas Hepping <info@mamoru.nl>.
 * Date: 13-6-2015
 * Time: 22:13
 */

namespace mamorunl\OTA\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use mamorunl\OTA\Facades\OTAToDataFormatter;

class OTAAjaxFlightController extends Controller
{
    /**
     * Display the price list for this flight
     *
     * @param Request $request
     */
    public function priceListPerRow(Request $request)
    {
        $decrypted_data = OTAToDataFormatter::decryptFromURL($request->get('d'));
        $decrypted_data = $decrypted_data[(int)$request->get('flight_id')];
        $rows = $decrypted_data['seats_free'];
        foreach ($rows as $row => $seats) {
            $price = ord(strtolower($row)) - 96;
            $new_data = OTAToDataFormatter::encryptFromURL($decrypted_data + ['price' => $price, 'row_letter' => $row]);
            echo "<div>" . $row . ": " . $seats . " free - &euro; " . $price . ".00 <a href=\"" . route('ota.flight.book',
                    ['d' => $new_data, 't' => $request->get('t')]) . "\">BOOK NOW</a></div>";
        }
    }
}
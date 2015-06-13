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

class OTAAjaxFlightController extends Controller {
    public function priceListPerRow(Request $request)
    {
        $decrypted_data = OTAToDataFormatter::decryptForAvailability($request->get('d'));
        $rows = $decrypted_data[0]['seats_free'];
        foreach($rows as $row => $seats) {
            $price = ord(strtolower($row)) - 96;
            $new_data = OTAToDataFormatter::encryptForAvailability($decrypted_data + ['price' => $price]);
            echo "<div>" . $row . ": " . $seats . " free - &euro; " . $price . ".00 <a href=\"" . route('ota.flight.book', ['d' => $new_data]) . "\">BOOK NOW</a></div>";
        }
    }
}
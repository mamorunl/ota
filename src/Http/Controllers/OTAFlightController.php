<?php
/**
 * Created by Bas Hepping <info@mamoru.nl>.
 * Date: 13-6-2015
 * Time: 20:27
 */

namespace mamorunl\OTA\Http\Controllers;


use App\Http\Controllers\Controller;

class OTAFlightController extends Controller {
    public function search()
    {
        return view('mamorunl-ota::flight.search');
    }
}
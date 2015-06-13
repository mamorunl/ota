<?php
/**
 * Created by Bas Hepping <info@mamoru.nl>.
 * Date: 13-6-2015
 * Time: 20:27
 */

namespace mamorunl\OTA\Http\Controllers;


use App\Http\Controllers\Controller;

class OTAFlightController extends Controller
{
    /**
     * Displays the form to search for a flight
     * @return \Illuminate\View\View
     */
    public function search()
    {
        return view('mamorunl-ota::flight.search');
    }
}
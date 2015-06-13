<?php
/**
 * Created by Bas Hepping <info@mamoru.nl>.
 * Date: 13-6-2015
 * Time: 20:27
 */

namespace mamorunl\OTA\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use mamorunl\OTA\Facades\DataToOTAFormatter;
use mamorunl\OTA\Facades\OTA;
use mamorunl\OTA\Facades\OTAToDataFormatter;
use mamorunl\OTA\Models\OTAConnection;

class OTAFlightController extends Controller
{
    /**
     * Displays the form to search for a flight
     *
     * @return \Illuminate\View\View
     */
    public function search()
    {
        return view('mamorunl-ota::flight.search');
    }

    public function postSearch(Request $request)
    {
        $ota_connection = new OTAConnection('onur');
        $request_data = $request->all();
        $request_data['date_arrival'] = date('Y-m-d', strtotime($request_data['date_arrival']));

        $request_data['traveller_info'] = [
            0 => [
                'quantity' => $request_data['num_adults'],
                'code'     => "ADT"
            ],
            1 => [
                'quantity' => $request_data['num_children'],
                'code'     => "CHD"
            ]
        ];

        $encrypted_data = OTA::availability($ota_connection, DataToOTAFormatter::forAvailability($request_data));

        return Redirect::route('ota.flight.display_result', ['d' => $encrypted_data]);
    }

    /**
     * Display the result from the search
     *
     * @param Request $request
     *
     * @return \Illuminate\View\View
     */
    public function result(Request $request)
    {
        $data = OTAToDataFormatter::decryptForAvailability($request->get('d'));

        return view('mamorunl-ota::flight.display', ['flights' => $data, 'd' => $request->get('d')]);
    }

    /**
     * Display the order form for the booking
     *
     * @param Request $request
     */
    public function book(Request $request)
    {
        $data = OTAToDataFormatter::decryptForAvailability($request->get('d'));
        dd($data);
    }
}
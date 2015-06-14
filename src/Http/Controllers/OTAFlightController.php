<?php
/**
 * Created by Bas Hepping <info@mamoru.nl>.
 * Date: 13-6-2015
 * Time: 20:27
 */

namespace mamorunl\OTA\Http\Controllers;


use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use mamorunl\OTA\Facades\DataToOTAFormatter;
use mamorunl\OTA\Facades\OTA;
use mamorunl\OTA\Facades\OTAToDataFormatter;
use mamorunl\OTA\Models\Booking;
use mamorunl\OTA\Models\OTAConnection;
use mamorunl\OTA\Models\Person;

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

        return Redirect::route('ota.flight.display_result',
            ['d' => $encrypted_data, 't' => OTAToDataFormatter::encryptFromURL($request_data)]);
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
        $data = OTAToDataFormatter::decryptFromURL($request->get('d'));

        return view('mamorunl-ota::flight.display',
            ['flights' => $data, 'd' => $request->get('d'), 't' => $request->get('t')]);
    }

    /**
     * Display the order form for the booking
     *
     * @param Request $request
     *
     * @return \Illuminate\View\View
     */
    public function book(Request $request)
    {
        $flight_data = OTAToDataFormatter::decryptFromURL($request->get('d'));
        $person_data = OTAToDataFormatter::decryptFromURL($request->get('t'));

        return view('mamorunl-ota::flight.book', [
            'flight_data' => $flight_data,
            'person_data' => $person_data,
            'd'           => $request->get('d'),
            't'           => $request->get('t')
        ]);
    }

    public function handleBooking(Request $request)
    {
        $flight_data = OTAToDataFormatter::decryptFromURL($request->get('d'));
        $person_data = OTAToDataFormatter::decryptFromURL($request->get('t'));
        $validator = Validator::make($request->all(), []);

        $validator->each('first_name_adult', ['required']);
        $validator->each('last_name_adult', ['required']);
        $validator->each('dateofbirth_adult', ['required']);
        $validator->each('area_code_adult', ['required']);
        $validator->each('city_code_adult', ['required']);
        $validator->each('phone_adult', ['required']);
        $validator->each('emailaddress_adult', ['required']);

        if (isset($person_data['children']) && $person_data['children'] > 0) {
            $validator->each('first_name_child', ['required']);
            $validator->each('last_name_child', ['required']);
            $validator->each('dateofbirth_child', ['required']);
        }

        if (isset($person_data['infants']) && $person_data['infants'] > 0) {
            $validator->each('first_name_infant', ['required']);
            $validator->each('last_name_infant', ['required']);
            $validator->each('dateofbirth_infant', ['required']);
        }

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            DB::transaction(function () use ($request, $person_data, $flight_data) {
                $booking = Booking::create($flight_data);

                $adults = $this->generatePerson('adult', $request, $booking, $person_data);

                $children = $this->generatePerson('child', $request, $booking, $person_data);

                $infants = $this->generatePerson('infant', $request, $booking, $person_data);

                Mail::send('mamorunl-ota::flight.emails.book',
                    ['booking' => $booking, 'adults' => $adults, 'children' => $children, 'infants' => $infants],
                    function ($message) use ($adults) {
                        $message->to($adults[0]->email, $adults[0]->first_name . " " . $adults[0]->last_name);
                        $message->subject(trans('mamorunl-ota::flight.book.email.subject'));
                    }
                );

            });
        } catch (Exception $e) {
            return Redirect::back()
                ->withInput();
        }

        return Redirect::route('ota.flight.search');

    }

    private function generatePerson($person_type, $request, $booking, $person_data)
    {
        $persons = [];
        if (isset($person_data['num_' . $person_type . 's'])) {
            for ($i = 0; $i < ($person_data['num_' . $person_type . 's']); $i++) {
                $person_data_generated = $this->generatePersonData($request, $i, $booking, $person_type);

                $persons[] = Person::create($person_data_generated);
            }
        }

        return $persons;
    }

    /**
     * @param Request $request
     * @param         $i
     * @param Booking $booking
     *
     * @param         $person_type
     *
     * @return array
     */
    private function generatePersonData(Request $request, $i, Booking $booking, $person_type)
    {
        $pt = constant("mamorunl\\OTA\\Models\\Person::PERSON_" . strtoupper($person_type));
        $person_data = [
            'gender'        => $request->get('gender_' . $person_type)[$i],
            'first_name'    => $request->get('first_name_' . $person_type)[$i],
            'last_name'     => $request->get('last_name_' . $person_type)[$i],
            'area_code'     => $request->get('area_code_' . $person_type)[$i],
            'city_code'     => $request->get('city_code_' . $person_type)[$i],
            'phone'         => $request->get('phone_' . $person_type)[$i],
            'email'         => $request->get('emailaddress_' . $person_type)[$i],
            'date_of_birth' => $request->get('dateofbirth_' . $person_type)[$i],
            'booking_id'    => $booking->id,
            'person_type'   => $pt
        ];

        return $person_data;
    }
}
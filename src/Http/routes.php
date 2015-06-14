<?php
/**
 * Created by Bas Hepping <info@mamoru.nl>.
 * Date: 13-6-2015
 * Time: 20:20
 */

$router->get('flight/search', [
    'as'   => 'ota.flight.search',
    'uses' => 'OTAFlightController@search'
]);

$router->post('flight/search', [
    'as'   => 'ota.flight.search',
    'uses' => 'OTAFlightController@postSearch'
]);

$router->get('flight/result', [
    'as'   => 'ota.flight.display_result',
    'uses' => 'OTAFlightController@result'
]);

$router->post('flight/price', [
    'as'   => 'ota.flight.load_price',
    'uses' => 'OTAAjaxFlightController@priceListPerRow'
]);

$router->get('flight/book', [
    'as'   => 'ota.flight.book',
    'uses' => 'OTAFlightController@book'
]);

$router->post('flight/book', [
    'as' => 'ota.flight.handle-booking',
    'uses' => 'OTAFlightController@handleBooking'
]);
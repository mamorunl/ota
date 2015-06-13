<?php
/**
 * Created by Bas Hepping <info@mamoru.nl>.
 * Date: 13-6-2015
 * Time: 20:20
 */

$router->get('flight/search', [
    'as'   => 'ota.flight.search',
    'uses' => 'OTAController@searchFlight'
]);

$router->post('flight/search', [
    'as'   => 'ota.flight.search',
    'uses' => 'OTAController@postSearchFlight'
]);
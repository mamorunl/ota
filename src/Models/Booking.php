<?php
/**
 * Created by Bas Hepping <info@mamoru.nl>.
 * Date: 14-6-2015
 * Time: 18:33
 */

namespace mamorunl\OTA\Models;


use Illuminate\Database\Eloquent\Model;

class Booking extends Model {
    protected $table = "ota_bookings";

    protected $fillable = [
        'airport_from',
        'airport_to',
        'date_arrival',
        'date_departure',
        'flight_number',
        'airline_code',
        'price',
        'row_letter'
    ];

    protected $dates = ['date_arrival', 'date_departure'];
}
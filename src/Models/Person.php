<?php
/**
 * Created by Bas Hepping <info@mamoru.nl>.
 * Date: 14-6-2015
 * Time: 18:47
 */

namespace mamorunl\OTA\Models;


use Illuminate\Database\Eloquent\Model;

class Person extends Model
{

    const PERSON_ADULT = 1;
    const PERSON_CHILD = 2;
    const PERSON_INFANT = 3;

    const GENDER_FEMALE = 0;
    const GENDER_MALE = 1;

    protected $table = "ota_persons";

    protected $fillable = [
        'gender',
        'first_name',
        'last_name',
        'area_code',
        'city_code',
        'phone',
        'email',
        'date_of_birth',
        'booking_id',
        'person_type'
    ];
}
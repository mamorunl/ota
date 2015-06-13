<?php
/**
 * Created by Bas Hepping <info@mamoru.nl>.
 * Date: 13-6-2015
 * Time: 20:56
 */

namespace mamorunl\OTA\Facades;


use Illuminate\Support\Facades\Facade;

class OTA extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'mamorunl\OTA\Models\OTAHandler';
    }
}
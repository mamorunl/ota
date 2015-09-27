<?php
/**
 * Created by Bas Hepping <info@mamoru.nl>.
 * Date: 13-6-2015
 * Time: 21:08
 */

namespace mamorunl\OTA\Facades;


use Illuminate\Support\Facades\Facade;

class DataToOTAFormatter extends Facade {
    public static function getFacadeAccessor()
    {
        return 'mamorunl\OTA\Models\DataToOTAFormatter';
    }
}
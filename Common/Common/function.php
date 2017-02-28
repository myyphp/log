<?php
/**
 * Created by PhpStorm.
 * User: Carisok
 * Date: 2017/2/23
 * Time: 14:19
 */

if (!function_exists('logic')) {
    function logic($logic)
    {
        return D($logic, 'Logic');
    }
}

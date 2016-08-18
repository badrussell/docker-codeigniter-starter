<?php

function dump($dump)
{
    echo '<pre>';
    print_r($dump);
    echo '</pre>';
}

function arrayToObject($d)
{
    if (is_array($d)) {
        /*
         * Return array converted to object
         * Using __FUNCTION__ (Magic constant)
         * for recursive call
         */
        return (object)array_map(__FUNCTION__, $d);
    } else {
        // Return object
        return $d;
    }
}

?>

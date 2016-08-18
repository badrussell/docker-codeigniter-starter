<?php

/**
 * Return the last key of an array
 * @param array $array
 * @return int index of last element
 */
function getLastKey(array $array)
{
    reset($array);
    end($array);

    return key($array);
}

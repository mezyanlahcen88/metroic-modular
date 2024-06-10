<?php


/**
 * List of Genders.
 *
 * @return void
 */
if (!function_exists('genders')) {
    function genders()
    {
        return  $Genders = [
        'male'=> 'Male',
        'female'=> 'Female',
      ];
    }
}

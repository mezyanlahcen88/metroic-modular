<?php

use App\Models\User;
use App\Models\Country;
use App\Models\Language;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;


/**
 * List of users.
 *
 * @return void
 */
if (!function_exists('users')) {
    function users()
    {

    }
}

/**
 * List of Roles.
 *
 * @return void
 */
if (!function_exists('roles')) {
    function roles()
    {
      return $roles = Role::pluck('name','name');
    }
}

/**
 * List of Countries.
 *
 * @return void
 */
if (!function_exists('countries')) {
    function countries()
    {
      return $countries = Country::pluck('name','id');
    }
}

/**
 * List of languages.
 *
 * @return void
 */
if (!function_exists('dynamicLang')) {
    function dynamicLang()
    {
      return $languages = Language::pluck('name','id');
    }
}

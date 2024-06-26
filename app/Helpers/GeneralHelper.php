<?php
use App\Models\City;
use App\Models\Rate;
use App\Models\Time;
use App\Models\User;
use App\Models\State;
use App\Models\Country;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Language;
use App\Models\AditionalRate;
use App\Models\EmailAttachement;
use App\Models\ProductTranslate;
use App\Models\CategoryTranslate;
use App\Models\Client;
use App\Models\Exercice;
use App\Models\LanguageTranslate;
use App\Models\ProductAttachement;
use App\Models\MainSupplyTranslate;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Models\ManufacturerTranslate;
use App\Models\Numerotation;
use App\Models\TrackClientDocs;
use Dotenv\Util\Str;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Carbon\Carbon;

/**
 * Get the ID of the default language.
 *
 * @return int|null The ID of the default language, or null if not found.
 */
if (!function_exists('getDefaultLangId')) {
    function getDefaultLangId()
    {
        $defaultLanguage = Language::where('isDefault', 1)->first();
        return $defaultLanguage;
    }
}
/**
 * Get the ID of the language based on the locale.
 *
 * @param string $locale The locale of the language.
 * @return int|null The ID of the language, or null if not found.
 */
if (!function_exists('getLangId')) {
    function getLangId($locale)
    {
        $language = Language::where('locale', $locale)->first()->id;
        return $language;
    }
}
/**
 * Get the name of the language based on the locale.
 *
 * @param string $locale The locale of the language.
 * @return string|null The name of the language, or null if not found.
 */
if (!function_exists('getLangName')) {
    function getLangName($locale)
    {
        $language = Language::where('locale', $locale)->first()->name;
        return $language;
    }
}
/**
 * Store translations for the current language to a language-specific JSON file.
 *
 * @return void
 */
if (!function_exists('storeTranslaionToLang')) {
    function storeTranslaionToLang()
    {
        $locale = App::getLocale();
        // $locale = 'en';
        $id = getLangId($locale);
        $objects = LanguageTranslate::where('language_id', $id)->pluck('translation', 'label');
        Storage::disk('lang')->delete($locale . '.json');
        Storage::disk('lang')->put($locale . '.json', $objects);
    }
}
/**
 * Store sidebar information as JSON file.
 *
 * @return void
 */
if (!function_exists('storeSidebar')) {
    function storeSidebar()
    {
        $sidebar = [
            'users' => User::count(),
            'roles' => Spatie\Permission\Models\Role::count(),
        ];
        Storage::put('public/sidebar/sidebar.json', json_encode($sidebar));
    }
}
/**
 * Get sidebar information from the stored JSON file.
 * If the file doesn't exist, it will be created using the storeSidebar() function.
 *
 * @return array The sidebar information as an associative array.
 */
if (!function_exists('getSidebar')) {
    function getSidebar()
    {
        $sideBarJson = Storage::disk('public')->get('sidebar/sidebar.json');
        if (!$sideBarJson) {
            storeSidebar();
        }
        return json_decode(Storage::disk('public')->get('sidebar/sidebar.json'), true);
    }
}
/**
 * Save settings from a database table to a JSON file.
 *

 * @return void
 */

// if (!function_exists('storeSetting')) {
//     function storeSetting()
//     {
//         $settings = Setting::pluck('option_value', 'option_name');
//         Storage::disk('public')->put('settings/setting.json', $settings);
//     }
// }

// if (!function_exists('getSettings')) {
//     function getSettings()
//     {
//         $settings = json_decode(Storage::disk('public')->get('settings/setting.json'), true);
//         if (!$settings) {
//             $settings = Setting::pluck('option_value', 'option_name');
//             Storage::disk('public')->put('settings/setting.json', $settings);
//         }

//         return $settings;
//     }
// }

/**
 * Get the active languages.
 *
 * @return \Illuminate\Database\Eloquent\Collection The collection of active languages.
 */

if (!function_exists('languages')) {
    function languages()
    {
        $langauge = Language::where('status', 1)->get();
        return $langauge;
    }
}
/**
 * Get the default language.
 *
 * @return \Illuminate\Database\Eloquent\Model|null The default language model, or null if not found.
 * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
 */
if (!function_exists('getDefaultLanguage')) {
    function getDefaultLanguage()
    {
        $langauge = Language::where('isDefault', 1)->first();
        return $langauge;
    }
}

/**
 * Accept file types.
 *
 * @return string The string of file types.
 */
if (!function_exists('acceptFileType')) {
    function acceptFileType()
    {
        return '.pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.txt,.csv,.ppt,.pptx,.xls,.xlsx';
    }
}

/**
 * Accept file image types.
 *
 * @return string The string of file image types.
 */
if (!function_exists('acceptImageType')) {
    function acceptImageType()
    {
        return 'image/jpeg,image/png,image/gif,image/bmp';
    }
}




if (!function_exists('checkStatus')) {
    function checkStatus()
    {
         $status = [
            'issued'  =>  'Émis',
            'on_hold'  =>  'En attente',
            'present'  =>  'Présenté',
            'cashed'  =>  'Encaissé',
            'rejected'  =>  'Rejeté',
            'canceled'  =>  'Annulé',
            'expired'  =>  'Expiré',

        ];
         return $status;
    }
}
if (!function_exists('formatDateIndex')) {
    function formatDateIndex($date)
    {
       $dateVal = Carbon::createFromFormat('Y-m-d H:i:s',$date)->format('d/m/Y');
         return $dateVal;
    }
}
if (!function_exists('formatDateEdit')) {
    function formatDateEdit($date)
    {
       $dateVal = Carbon::createFromFormat('Y-m-d H:i:s',$date)->format('Y-m-d');
         return $dateVal;
    }
}


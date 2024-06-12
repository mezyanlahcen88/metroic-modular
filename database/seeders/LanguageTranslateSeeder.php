<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class LanguageTranslateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($lang_id = 1)
    {
        $now = Carbon::now();
        DB::table('language_translates')->insert([
            ['language_id' => $lang_id, 'model' => 'Navigation', 'label' => 'navigation_navigation_configuration', 'translation' => ' configuration', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id,'model' => 'Navigation', 'label' => 'navigation_navigation_dashboard', 'translation' => ' dashboard', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id,'model' => 'Navigation', 'label' => 'navigation_navigation_manage_users', 'translation' => ' Manage Users', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id,'model' => 'Navigation', 'label' => 'navigation_navigation_payment_currencies', 'translation' => ' payment Currencies', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id,'model' => 'Navigation', 'label' => 'navigation_navigation_payment_methods', 'translation' => ' payment methods', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id,'model' => 'Navigation', 'label' => 'navigation_navigation_payment_terms', 'translation' => ' payment terms', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id,'model' => 'Navigation', 'label' => 'navigation_navigation_payments', 'translation' => ' Payments', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id,'model' => 'Navigation', 'label' => 'navigation_navigation_permissions', 'translation' => ' roles and permissions', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id,'model' => 'Navigation', 'label' => 'navigation_navigation_roles_list', 'translation' => ' roles list', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id,'model' => 'Navigation', 'label' => 'navigation_navigation_users_list', 'translation' => ' users list', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id,'model' => 'Navigation', 'label' => 'navigation_navigation_countries', 'translation' => ' countries', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id,'model' => 'Navigation', 'label' => 'navigation_navigation_cities', 'translation' => ' cities', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id,'model' => 'Navigation', 'label' => 'navigation_navigation_emails_types', 'translation' => ' emails types', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id,'model' => 'Navigation', 'label' => 'navigation_navigation_emails', 'translation' => ' emails', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id, 'model' => 'Navigation','label' => 'navigation_navigation_mainsupplies', 'translation' => ' Main Supplies', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id,'model' => 'Navigation', 'label' => 'navigation_navigation_categories', 'translation' => ' categories', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id,'model' => 'Navigation', 'label' => 'navigation_navigation_brands', 'translation' => ' brands', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id,'model' => 'Navigation', 'label' => 'navigation_navigation_settings', 'translation' => ' settings', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id,'model' => 'Navigation', 'label' => 'navigation_navigation_manufacturers', 'translation' => ' Manufacturers', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id,'model' => 'Navigation', 'label' => 'navigation_navigation_ecommerce', 'translation' => ' ecommerce', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id,'model' => 'Navigation', 'label' => 'navigation_navigation_companys', 'translation' => ' companys', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id,'model' => 'Navigation', 'label' => 'navigation_navigation_companies', 'translation' => ' Companies', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id,'model' => 'Navigation', 'label' => 'navigation_navigation_clients', 'translation' => 'Particulars', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id,'model' => 'Navigation', 'label' => 'navigation_navigation_products', 'translation' => ' Products', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id,'model' => 'Navigation', 'label' => 'navigation_navigation_manage_language', 'translation' => ' languages', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id,'model' => 'Navigation', 'label' => 'navigation_navigation_language_translation', 'translation' => 'language translation', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id,'model' => 'Navigation', 'label' => 'navigation_navigation_suppliers', 'translation' => ' suppliers', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id,'model' => 'Navigation', 'label' => 'navigation_navigation_company_groupes', 'translation' => 'company groupes', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id, 'model' => 'Navigation','label' => 'navigation_navigation_banks', 'translation' => 'banks', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id,'model' => 'Navigation', 'label' => 'navigation_navigation_recepient_adresses', 'translation' => 'recepient adresses', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id,'model' => 'Navigation', 'label' => 'navigation_navigation_pickup_adresses', 'translation' => 'pickup adresses', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id,'model' => 'General', 'label' => 'general_general_action', 'translation' => 'Action', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id,'model' => 'General', 'label' => 'general_general_save', 'translation' => 'Save', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id, 'model' => 'General','label' => 'general_general_update', 'translation' => 'Update', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id, 'model' => 'General','label' => 'general_general_close', 'translation' => 'Close', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id, 'model' => 'General','label' => 'general_general_return', 'translation' => 'Return', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id, 'model' => 'General','label' => 'general_general_configuration', 'translation' => 'Configuration', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id, 'model' => 'General','label' => 'general_general_search', 'translation' => 'Search', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id, 'model' => 'General','label' => 'general_general_add', 'translation' => 'Add', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id, 'model' => 'General','label' => 'general_general_select', 'translation' => 'Choose One', 'created_at' => $now, 'updated_at' => $now],
            ['language_id' => $lang_id,'model' => 'General', 'label' => 'general_general_super', 'translation' => 'Super', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}

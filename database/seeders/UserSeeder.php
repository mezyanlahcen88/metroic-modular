<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'uuid' => Str::uuid(),
            'first_name' => 'Hassan',
            'last_name' => 'Mzn',
            'username' => 'admin',
            'occupation' => 'Developper',
            'email' => 'demo@demo.com',
            'password' => bcrypt('demo'),
            'isactive' => 1,
            'roles_name' => 'admin',
            'country_id' => 149,
            'language_id' => 1,
            'state' => 'Kénitra',
            'city' => 'Kénitra',
            'phone' => '+212602086429',
            'picture' => 'avatar.jpg',
            'address' => 'maroc kenitra elwafaa',
            'code_postale' => '14000',
            'gender' => 'male',
            'email_verified_at'=>now()
        ]);

        $role = Role::create(['name' => 'admin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole($role->id);
    }
}

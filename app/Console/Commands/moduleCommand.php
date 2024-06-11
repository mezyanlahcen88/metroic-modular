<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Groupe;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;

class moduleCommand extends Command
{
    protected $signature = 'make:module {name}';

    protected $description = 'Speed up the creation of New Record';

    public function handle()
    {
        $name = $this->argument('name');
        $className = ucfirst($name);
        $lowerName = strtolower($name);
        $plural = Str::plural($lowerName);
        // Generate the module
        Artisan::call('module:make', ['name' => [$className]]);
        // Generate the advanced model
        // Artisan::call('make:mdl', [
        //     'name' => "{$name}",
        // ]);

        // Generate the migration
        // Artisan::call('make:module-migration', [
        //     'name' => "{$className}",
        // ]);
        // Generate the Factory
        Artisan::call('make:module-factory', [
            'name' => "{$className}",
        ]);

        // // Generate the seeder
        Artisan::call('make:module-seeder', [
            'name' => "{$name}",
        ]);



        // Generate the advanced controller
        Artisan::call('make:module-controller', [
            'name' => "{$name}",
        ]);

        // ###################### view section ######################
        // Generate the advanced index
        Artisan::call('make:index', [
            'name' => "{$name}",
        ]);
        // Generate the advanced create
        Artisan::call('make:create', [
            'name' => "{$name}",
        ]);
        // Generate the advanced edit
        Artisan::call('make:edit', [
            'name' => "{$name}",
        ]);
        // Generate the advanced trashed index
        Artisan::call('make:trashedindex', [
            'name' => "{$name}",
        ]);
        // Generate the advanced action
        Artisan::call('make:actions', [
            'name' => "{$name}",
        ]);
        // Generate the advanced trashed action
        Artisan::call('make:tactions', [
            'name' => "{$name}",
        ]);
        // Generate the advanced trashed table
        Artisan::call('make:trashedTable', [
            'name' => "{$name}",
        ]);
        // Generate the advanced  table
        Artisan::call('make:table', [
            'name' => "{$name}",
        ]);
        // ###################### Validation section ######################
        // Generate the advanced form request
        Artisan::call('make:module-storeRequest', [
            'name' => "{$name}",
        ]);
        Artisan::call('make:module-updateRequest', [
            'name' => "{$name}",
        ]);
        // ###################### Route section ######################
        // Generate the advanced route
        Artisan::call('make:module-route', [
            'name' => "{$name}",
        ]);
        // ###################### Crud section ######################
        $groupId = $this->createGroup($className);
        $this->createPermissions($groupId,$className);
        // ###################### Message section ######################
        $this->info('Module created successfully!');
    }

    /**
     * Create a new group.
     *
     * @param string $name
     * @return void
     */
    protected function createGroup($name)
    {
        // Assuming you have a Group model and a groups table
        $group = new Groupe();
        $group->name = $name;
        $group->save();

        $this->info("Group '{$name}' created successfully!");
        return $group->id;
    }
/**
     * Create permissions for the specified group.
     *
     * @param int $groupId
     * @return void
     */
    protected function createPermissions($groupId , $className)
    {
        $permissions = [
            [
                'name' => $className.'-create',
                'libele' => 'Add {$className}',  // 'libele' translates to 'label'
                'guard_name' => 'web',
                'groupe_id' => $groupId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
              ],
            //   [
            //     'name' => '{$className}-show',
            //     'libele' => 'View {$className}',
            //     'guard_name' => 'web',
            //     'groupe_id' => $groupId,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            //   ],
            //   [
            //     'name' => '{$className}-edit',
            //     'libele' => 'Edit {$className}',
            //     'guard_name' => 'web',
            //     'groupe_id' => $groupId,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            //   ],
            //   [
            //     'name' => '{$className}-delete',
            //     'libele' => 'Delete {$className}',
            //     'guard_name' => 'web',
            //     'groupe_id' => $groupId,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            //   ],
            //   [
            //     'name' => '{$className}-list',
            //     'libele' => '{$className} List',
            //     'guard_name' => 'web',
            //     'groupe_id' => $groupId,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            //   ],
            //   [
            //     'name' => '{$className}-trashed',
            //     'libele' => 'Trashed {$className} List',
            //     'guard_name' => 'web',
            //     'groupe_id' => $groupId,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            //   ],
            //   [
            //     'name' => '{$className}-forse-delete',
            //     'libele' => 'Force Delete',
            //     'guard_name' => 'web',
            //     'groupe_id' => $groupId,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            //   ],
            //   [
            //     'name' => '{$className}-restore',
            //     'libele' => 'Restore {$className}',
            //     'guard_name' => 'web',
            //     'groupe_id' => $groupId,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            //   ]
        ];

        Permission::insert($permissions);

        $this->info('Permissions created successfully!');
    }
}



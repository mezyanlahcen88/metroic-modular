<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Groupe;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;

class moduleMigrationCommand extends Command
{
    protected $signature = 'make:module-base-migration {table} {model}';

    protected $description = 'Generate translation model create and edit';

    public function handle()
    {
        $model = $this->argument('model');
        $table = $this->argument('table');

        // Generate the translation
        Artisan::call('generate:translation', ['table' => $table,'model'=> $model]);
        // Generate the advanced model
        Artisan::call('make:module-model', ['table' => $table,'model'=> $model]);
        // Generate the advanced cretae blade
        Artisan::call('make:create', ['table' => $table,'model'=> $model]);
        // Generate the advanced edit blade
        Artisan::call('make:edit', ['table' => $table,'model'=> $model]);

      $this->info('Generate translation model create and edit for :'.$model );

    }
}



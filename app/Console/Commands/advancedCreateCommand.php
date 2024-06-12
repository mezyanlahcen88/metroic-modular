<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class advancedCreateCommand extends Command
{
    protected $signature = 'make:create {name : The name of the create blade} {table : The name of the table}';

    protected $description = 'Create a new create blade';

    public function handle()
    {
        $name = $this->argument('name');
        $table = $this->argument('table');
        $lowerName = strtolower($name);
        $plural = Str::plural($lowerName);
        $modelName = ucfirst($name);

        // get the directory first
        $directoryPath = base_path('Modules/'.$modelName.'/resources/views');

        // Get the content of the stub file
        $stub = File::get(app_path('Console/Commands/stubs/template/create.stub'));

        // Generate the form content based on table columns
        $columns = Schema::getColumnListing($table);
        $formContent = $this->generateFormContent($columns);

        // Replace placeholders in the stub content
        $stub = str_replace('{{lowerName}}', $lowerName, $stub);
        $stub = str_replace('{{plural}}', $plural, $stub);
        $stub = str_replace('{{model}}', $name, $stub);
        $stub = str_replace('{{formContent}}', $formContent, $stub);

        // Create the Blade view file inside the new directory
        $filePath = "{$directoryPath}/create.blade.php";
        File::put($filePath, $stub);

        $this->info('Create blade created successfully!');
    }

    private function generateFormContent($columns)
    {
        $excludedColumns = ['id', 'uuid', 'created_at', 'updated_at', 'deleted_at'];
        $avatarColumns = ['picture', 'logo', 'avatar'];
        $formContent = '';
        $avatarContent = '';
        $hasAvatarColumn = false;

        foreach ($columns as $column) {
            if (in_array($column, $excludedColumns)) {
                continue;
            }

            if (strpos($column, '_id') !== false) {
                $option = Str::plural(str_replace('_id', '', $column));
                $formContent .= <<<EOT

                            <x-single-select cols="col-md-6" div-id="{$column}" column="{$column}" model="user"
                                label="user_form_{$column}" optional="text-danger" id="{$column}" :options="{$option}()" :object=false />
EOT;
            } elseif (in_array($column, $avatarColumns)) {
                $hasAvatarColumn = true;
                $avatarContent .= <<<EOT

                        <x-image-field :background-url="url('/assets/media/svg/avatars/blank.svg')" :image-url="url('/assets/media/avatars/300-1.jpg')" avatar-name="{$column}" />
EOT;
            } else {
                $formContent .= <<<EOT

                            <x-input-field cols="col-md-6" divId="{$column}" column="{$column}" model="user"
                                optional="text-danger" inputType="text" className="" columnId="{$column}"
                                columnValue="{{ old('{$column}') }}" attribute="required" readonly="false" />
EOT;
            }
        }

        if ($hasAvatarColumn) {
            return <<<EOT
            <div class="col-md-9">
                <div class="card card-bordered">
                    <div class="card-header">
                        <h3 class="card-title">Title</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            {$formContent}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Picture</h3>
                    </div>
                    <div class="card-body text-center">
                        {$avatarContent}
                    </div>
                </div>
            </div>
EOT;
        } else {
            return <<<EOT
            <div class="col-md-12">
                <div class="card card-bordered">
                    <div class="card-header">
                        <h3 class="card-title">Title</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            {$formContent}
                        </div>
                    </div>
                </div>
            </div>
EOT;
        }
    }
}

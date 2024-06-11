<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class AdvancedModelCommand extends Command
{
    protected $signature = 'make:mdl {name : The name of the Model class} {table : The name of the database table}';

    protected $description = 'Create a new Model class with fillable properties based on a table';

    public function handle()
    {
        $name = $this->argument('name');
        $table = $this->argument('table');
        $className = ucfirst($name);
        $modelName = ucfirst($name);
        $lowerName = strtolower($name);
        $plural = Str::plural($lowerName);

        // Get columns from the specified table
        $columns = DB::getSchemaBuilder()->getColumnListing($table);

        if (empty($columns)) {
            $this->error("No columns found for table: $table");
            return;
        }

        // Filter out the columns to exclude from the fillable array
        $excludedColumns = ['id', 'created_at', 'updated_at'];
        $filteredColumns = array_diff($columns, $excludedColumns);

        // Generate fillable array string
        $fillableArray = "protected \$fillable = [\n";
        foreach ($filteredColumns as $column) {
            $fillableArray .= "        '$column',\n";
        }
        $fillableArray .= "    ];\n";

        // Generate files array string
        $fileColumns = array_intersect($columns, ['picture', 'avatar', 'logo']);
        $filesArray = "private \$files = [\n";
        foreach ($fileColumns as $fileColumn) {
            $filesArray .= "        '$fileColumn',\n";
        }
        $filesArray .= "    ];\n";

        // Generate getRowsTable method
        $rowsTableColumns = array_slice($columns, 0, 5);
        $rowsTableArray = "public function getRowsTable()\n    {\n        return [\n";
        foreach ($rowsTableColumns as $column) {
            $rowsTableArray .= "            '$column' => '$column',\n";
        }
        $rowsTableArray .= "        ];\n    }\n";

        // Generate getRowsTableTrashed method
        $rowsTableTrashedArray = "public function getRowsTableTrashed()\n    {\n        return [\n";
        foreach ($rowsTableColumns as $column) {
            $rowsTableTrashedArray .= "            '$column' => '$column',\n";
        }
        $rowsTableTrashedArray .= "        ];\n    }\n";

        // Generate relationships
        $relationshipsArray = "";
        foreach ($columns as $column) {
            if (Str::endsWith($column, '_id')) {
                $relatedModel = ucfirst(Str::camel(str_replace('_id', '', $column)));
                $relationshipsArray .= "public function $relatedModel()\n    {\n        return \$this->belongsTo({$relatedModel}::class);\n    }\n\n";
            }
        }

        // Read and replace stub content
        $stub = File::get(app_path('Console/Commands/stubs/model.stub'));
        $stub = str_replace('{{class}}', $className, $stub);
        $stub = str_replace('{{model}}', $modelName, $stub);
        $stub = str_replace('{{plural}}', $plural, $stub);
        $stub = str_replace('{{fillable}}', $fillableArray, $stub);
        $stub = str_replace('{{files}}', $filesArray, $stub);
        $stub = str_replace('{{getRowsTable}}', $rowsTableArray, $stub);
        $stub = str_replace('{{getRowsTableTrashed}}', $rowsTableTrashedArray, $stub);
        $stub = str_replace('{{relationships}}', $relationshipsArray, $stub);

        // Delete folder
        $directoryPath = base_path('Modules/' . $modelName . '/App/Models');
        File::deleteDirectory($directoryPath);

        // Create the directory
        File::makeDirectory($directoryPath, 0755, true);
        $filePath = base_path('Modules/' . $name . '/app/Models/' . $className . '.php');

        if (File::exists($filePath)) {
            $this->error('Model class already exists!');
            return;
        }

        File::put($filePath, $stub);

        $this->info('Model created successfully inside the module!');
    }
}

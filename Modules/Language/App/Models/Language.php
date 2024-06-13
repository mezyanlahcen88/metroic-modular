<?php

namespace Modules\Language\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Language\Database\factories\LanguageFactory;
use Illuminate\Support\Str;

class Language extends Model
{
    use HasFactory;



     protected $fillable = [
        'name',
        'locale',
        'isDefault',
        'status',
        'visible',
        'flag_path',
    ];

    private $files = [
    ];

    public function getFiles()
    {
        return $this->files;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    //  put the relation of this Model Here

    /**
     *getters pour recuperer les attribute de type file pour l'utiliser dans le crud
     *
     */

   public function getRowsTable()
    {
        return [
            'name' => 'name',
            'locale' => 'locale',
            'isDefault' => 'isDefault',
        ];
    }




    /**
     *getters pour recuperer les attribute de type file pour l'utiliser dans le crud
     *
     */

  public function getRowsTableTrashed()
    {
        return [
            'name' => 'name',
            'locale' => 'locale',
            'isDefault' => 'isDefault',
        ];
    }

}

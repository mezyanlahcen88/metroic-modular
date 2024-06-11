<?php

namespace Modules\Post\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Post\Database\factories\PostFactory;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

     protected $fillable = [
        'name',
        'author',
        'picture',
        'category_id',
        'user_id',
    ];

    private $files = [
        'picture',
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
public function Category()
    {
        return $this->belongsTo(Category::class);
    }

public function User()
    {
        return $this->belongsTo(User::class);
    }


    /**
     *getters pour recuperer les attribute de type file pour l'utiliser dans le crud
     *
     */

   public function getRowsTable()
    {
        return [
            'id' => 'id',
            'name' => 'name',
            'author' => 'author',
            'picture' => 'picture',
            'category_id' => 'category_id',
        ];
    }




    /**
     *getters pour recuperer les attribute de type file pour l'utiliser dans le crud
     *
     */

  public function getRowsTableTrashed()
    {
        return [
            'id' => 'id',
            'name' => 'name',
            'author' => 'author',
            'picture' => 'picture',
            'category_id' => 'category_id',
        ];
    }

}

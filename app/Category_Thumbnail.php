<?php

namespace App;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class Category_Thumbnail extends Model
{

    use HasSoftDelete;
    protected $table = "category_thumbnail";
    protected $fillable = ['id', 'category_id', 'small', 'medium', 'large'];
    protected $deletedAt = 'deleted_at';

    public function parent()
    {
        return $this->belongsTo('\App\Category', 'category_id', 'id');
    }
}

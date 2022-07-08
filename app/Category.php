<?php

namespace App;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class Category extends Model
{

    use HasSoftDelete;
    protected $table = "categories";
    protected $fillable = ['title', 'description', 'slug', 'parent_id', 'author_id',  'is_published'];
    protected $deletedAt = 'deleted_at';

    public function parent()
    {
        return $this->belongsTo('\App\Category', 'parent_id', 'id');
    }

    public function author()
    {
        return $this->belongsTo('\App\Member', 'author_id', 'id');
    }

    public function thumbnail()
    {
        return $this->hasOne('\App\Category_Thumbnail', 'category_id', 'id');
    }

    public function is_published()
    {
        switch ($this->is_published) {
            case 0:
                return 'Suspended';
            case 1:
                return 'Published';
            default:
                return "-";
                break;
        }
    }
}

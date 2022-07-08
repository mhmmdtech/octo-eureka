<?php

namespace App;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class Post extends Model
{

    use HasSoftDelete;
    protected $table = "posts";
    protected $fillable = ['title', 'description', 'body', 'slug', 'author_id', 'category_id', 'is_published', 'is_choiced', 'views'];
    protected $deletedAt = 'deleted_at';

    public function category()
    {
        return $this->belongsTo('\App\Category', 'category_id', 'id');
    }

    public function author()
    {
        return $this->belongsTo('\App\Member', 'author_id', 'id');
    }

    public function thumbnail()
    {
        return $this->hasOne('\App\Post_Thumbnail', 'post_id', 'id');
    }

    public function attachments()
    {
        return $this->hasMany('\App\Post_Attachment', 'post_id', 'id')->get();
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
    public function is_choiced()
    {
        switch ($this->is_choiced) {
            case 0:
                return 'Not';
            case 1:
                return 'Yes';
            default:
                return "-";
                break;
        }
    }
}

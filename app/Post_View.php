<?php

namespace App;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class Post_View extends Model
{

    use HasSoftDelete;
    protected $table = "post_view";
    protected $fillable = ['id', 'post_id', 'visitor_detector'];
    protected $deletedAt = 'deleted_at';

    public function parent()
    {
        return $this->belongsTo('\App\Post', 'post_id', 'id');
    }
}

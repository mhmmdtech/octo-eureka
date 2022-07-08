<?php

namespace App;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class Post_Attachment extends Model
{

    use HasSoftDelete;
    protected $table = "post_attachment";
    protected $slugColumn = 'name';
    protected $fillable = ['id', 'post_id', 'name', 'path', 'type', 'size'];
    protected $deletedAt = 'deleted_at';

    public function parent()
    {
        return $this->belongsTo('\App\Post', 'post_id', 'id');
    }
}

<?php

namespace App;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class Member extends Model
{
    use HasSoftDelete;
    protected $table = "members";
    protected $slugColumn = 'username';
    protected $fillable = ['name', 'family', 'username', 'email', 'password', 'avatar', 'status', 'role', 'verify_token', 'verify_token_expiry', 'forget_token', 'forget_token_expiry'];
    protected $deletedAt = 'deleted_at';
    public function fullname()
    {
        return $this->name . " " . $this->family;
    }
    public function status()
    {
        switch ($this->status) {
            case 0:
                return 'Deactived';
            case 1:
                return 'Activated';
            default:
                return "-";
                break;
        }
    }
}

<?php
namespace App\Models\DB;
use Illuminate\Database\Eloquent\Model;

class admin extends Model{
    protected $table = 'admins';
    protected $primaryKey = 'id';
    protected $guarded = ["id"];
    protected $hidden = ["id"];
    public $timestamps = false;
    public function check_password($password): bool{
        return $this -> password == $password;
    }
}
?>
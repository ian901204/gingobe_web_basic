<?php
namespace App\Models\DB;
use Illuminate\Database\Eloquent\Model;

class admin extends Model{
    protected $table = 'admins';
    protected $primaryKey = 'id';
    protected $fillable = ["name", "account", "password"];
    public $timestamps = false;
    public function check_password($password){
        if ($this -> password == $password){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
?>
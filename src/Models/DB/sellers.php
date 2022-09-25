<?php
namespace App\Models\DB;
use Illuminate\Database\Eloquent\Model;

class Order extends Model{
    protected $table = 'seller';
    protected $primaryKey = 'id';
    protected $fillable = ["name", "phone"];
    public $timestamps = false;
}
?>
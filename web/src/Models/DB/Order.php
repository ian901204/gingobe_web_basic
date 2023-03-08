<?php
namespace App\Models\DB;
use Illuminate\Database\Eloquent\Model;

class Order extends Model{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $fillable = ["name", "telephone", "phone", "seller_id", "amount", "note"];
    public $timestamps = false;
}
?>
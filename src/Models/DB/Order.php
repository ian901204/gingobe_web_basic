<?php
namespace App\Models\DB;
use Illuminate\Database\Eloquent\Model;

class Order extends Model{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $fillable = ["client_name", "client_phone", "order_address", "seller_id", "product_amount", "product_size", "description"];
    public $timestamps = false;
}
?>
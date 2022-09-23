<?php
namespace App\Models\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Order extends Model{
    use HasUuids;
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $fillable = ["client_name", "client_phone", "order_address", "seller_id", "product_amount", "product_size", "description"];
    public $timestamps = false;
}
?>
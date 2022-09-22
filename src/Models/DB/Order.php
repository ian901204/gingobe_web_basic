<?php
namespace App\Models\DB;
use Illuminate\Database\Eloquent\Model;

class Order extends Model{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $fillable = ["client_id", "description", "detail", "	salesperson_id	"];
    public $timestamps = false;
}
?>
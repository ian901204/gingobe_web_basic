<?php
namespace App\Models\DB;
use Illuminate\Database\Eloquent\Model;

class Order extends Model{
    protected $table = 'orders';
    protected $primaryKey = 'id';
}
?>
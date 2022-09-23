<?php
namespace App\Models\DB;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Order extends Model{
    use HasUuids;
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $fillable = ["client_name", "client_phone", "order_address", "seller_id", "product_amount", "product_size", "description"];
    public $timestamps = false;

    protected $keyType = 'string';

    public $incrementing = false;
    protected static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            $model->setAttribute($model->getKeyName(), Uuid::uuid4());
        });
    }
}
?>
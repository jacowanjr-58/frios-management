<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class RestockOrderItem extends Model {
    protected $fillable = ['restock_order_id','flavor_id','quantity_cases'];
    public function order(){ return $this->belongsTo(RestockOrder::class); }
    public function flavor(){ return $this->belongsTo(Flavor::class); }
}

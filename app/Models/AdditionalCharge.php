<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class AdditionalCharge extends Model {
    protected $fillable = ['name','charge_type','amount','is_optional'];
    public function restockOrders(){ return $this->belongsToMany(RestockOrder::class,'restock_order_additional_charge')->withPivot('included'); }
}

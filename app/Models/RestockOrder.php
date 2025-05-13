<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class RestockOrder extends Model {
    protected $fillable = ['franchisee_id','order_date','shipstation_order_id','status','ship_date','delivery_date'];
    public function franchisee(){ return $this->belongsTo(Franchisee::class); }
    public function items(){ return $this->hasMany(RestockOrderItem::class); }
    public function charges(){ return $this->belongsToMany(AdditionalCharge::class,'restock_order_additional_charge')->withPivot('included'); }
}

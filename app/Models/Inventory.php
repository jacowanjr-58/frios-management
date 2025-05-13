<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Inventory extends Model {
    protected $fillable = ['franchisee_id','flavor_id','custom_name','inventory_location_id','cases_on_hand','pops_on_hand'];
    public function franchisee(){ return $this->belongsTo(Franchisee::class); }
    public function flavor(){ return $this->belongsTo(Flavor::class); }
    public function location(){ return $this->belongsTo(InventoryLocation::class,'inventory_location_id'); }
    public function batches(){ return $this->hasMany(CaseBatch::class); }
}

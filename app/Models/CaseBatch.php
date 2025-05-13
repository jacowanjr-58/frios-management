<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CaseBatch extends Model {
    protected $fillable = ['inventory_id','batch_code','quantity_cases','expiration_date'];
    public function inventory(){ return $this->belongsTo(Inventory::class); }
}

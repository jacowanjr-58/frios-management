<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PosSaleItem extends Model {
    protected $fillable = ['pos_sale_id','flavor_id','quantity','unit_price'];
    public function sale(){ return $this->belongsTo(PosSale::class); }
    public function flavor(){ return $this->belongsTo(Flavor::class); }
}

<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class EventAllocation extends Model {
    protected $fillable = ['event_id','flavor_id','quantity_cases'];
    public function event(){ return $this->belongsTo(Event::class); }
    public function flavor(){ return $this->belongsTo(Flavor::class); }
}

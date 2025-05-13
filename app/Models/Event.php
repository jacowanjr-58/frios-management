<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Event extends Model {
    protected $fillable = ['franchisee_id','name','description','start_datetime','end_datetime','location','status','customer_id','staff_required'];
    public function allocations(){ return $this->hasMany(EventAllocation::class); }
    public function resources(){ return $this->belongsToMany(Resource::class,'event_resource'); }
    public function franchisee(){ return $this->belongsTo(Franchisee::class); }
    public function customer(){ return $this->belongsTo(Customer::class); }
}

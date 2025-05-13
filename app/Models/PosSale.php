<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PosSale extends Model {
    protected $fillable = ['franchisee_id','event_id','user_id','customer_id','sold_at','total_amount','tips_amount','sales_tax_amount','tax_enabled','payment_method','stripe_payment_id','square_charge_id'];
    public function items(){ return $this->hasMany(PosSaleItem::class); }
    public function franchisee(){ return $this->belongsTo(Franchisee::class); }
    public function user(){ return $this->belongsTo(User::class); }
    public function event(){ return $this->belongsTo(Event::class); }
    public function customer(){ return $this->belongsTo(Customer::class); }
}

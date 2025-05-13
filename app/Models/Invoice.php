<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Invoice extends Model {
    protected $fillable = ['franchisee_id','customer_id','invoice_date','due_date','status','is_estimate','accepted_at'];
    public function items(){ return $this->hasMany(InvoiceItem::class); }
    public function franchisee(){ return $this->belongsTo(Franchisee::class); }
    public function customer(){ return $this->belongsTo(Customer::class); }
}

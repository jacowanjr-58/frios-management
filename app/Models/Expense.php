<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Expense extends Model {
    protected $fillable = ['franchisee_id','expense_date','expense_category_id','expense_sub_category_id','vendor','description','amount','receipt_url','event_id'];
    public function category(){ return $this->belongsTo(ExpenseCategory::class,'expense_category_id'); }
    public function subCategory(){ return $this->belongsTo(ExpenseSubCategory::class,'expense_sub_category_id'); }
    public function franchisee(){ return $this->belongsTo(Franchisee::class); }
    public function event(){ return $this->belongsTo(Event::class); }
}

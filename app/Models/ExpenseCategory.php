<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ExpenseCategory extends Model {
    protected $fillable = ['name'];
    public function subCategories(){ return $this->hasMany(ExpenseSubCategory::class); }
}

<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class GeneralSetting extends Model {
    protected $fillable = ['key','value','scope','franchisee_id'];
    public function franchisee(){ return $this->belongsTo(Franchisee::class); }
}

<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class WorkSession extends Model {
    protected $fillable = ['user_id','started_at','ended_at'];
    public function user(){ return $this->belongsTo(User::class); }
}

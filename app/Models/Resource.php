<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Resource extends Model {
    protected $fillable = ['name','description'];
    public function events(){ return $this->belongsToMany(Event::class,'event_resource'); }
}

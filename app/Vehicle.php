<?php namespace App;
use \Illuminate\Database\Eloquent\Model;

/* 
 * Vehicle belongsTo ONE Maker
 * Maker hasMany Vehicles
 * 
 * Vehicle
 *   #series
 *      -Color
 *      -Power
 *      -Capacity
 *      -Speed
 * 
 * Maker
 *   #id
 *     - Name
 *     - Phone
 */


class Vehicle extends Model
{
    protected $table = 'vehicles';
    protected $primaryKey = 'series';
   //protected $fillable = ['series','color', 'power', 'capacity', 'speed', 'maker_id'];
    protected $fillable = ['color', 'power', 'capacity', 'speed', 'maker_id'];
    protected $hidden = ['series', 'created_at', 'updated_at', 'maker_id'];
    
    public function maker() 
    {
        return $this->belongsTo('App\Maker');
    }
}




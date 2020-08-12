<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'elements';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'type_id'];

    public function ocurrence()
    {
        return $this->hasMany('App\Occurrence_element');
    }

    public function condominium()
    {
        return $this->hasMany('App\Element_condominium');
    }

    public function type_id()
    {
        return $this->belongsToMany('App\Type');
    }

    public function types()
    {
        return Type::pluck('profile', 'id');
    }

    public function type()
    {
        return Type::find($this->type_id)->profile;
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($element) {
            $relationMethods = ['ocurrence', 'condominium'];

            foreach ($relationMethods as $relationMethod) {
                if ($element->$relationMethod()->count() > 0) {
                    return false;
                }
            }
        });
    }

}

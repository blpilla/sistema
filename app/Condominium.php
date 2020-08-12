<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Condominium extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'condominia';

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
    protected $fillable = ['tower', 'ap'];

    public function element()
    {
        return $this->hasMany('App\Element_condominium');
    }

    public function towers()
    {
        return [1 => 1, 2 => 2];
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($element) {
            $relationMethods = ['element'];

            foreach ($relationMethods as $relationMethod) {
                if ($element->$relationMethod()->count() > 0) {
                    return false;
                }
            }
        });
    }
}

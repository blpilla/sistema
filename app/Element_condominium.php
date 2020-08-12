<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Element_condominium extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'element_condominia';

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
    protected $fillable = ['element_id', 'condominium_id'];

    public function element_id()
    {
        return $this->belongsToMany('App\Element');
    }

    public function condominium_id()
    {
        return $this->belongsToMany('App\Condominium');
    }

    public function condominium()
    {
        return Condominium::find($this->condominium_id);
    }

}

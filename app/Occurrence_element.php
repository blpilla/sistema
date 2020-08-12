<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Occurrence_element extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'occurrence_elements';

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
    protected $fillable = ['element_id', 'occurrence_id'];

    public function element_id()
    {
        return $this->belongsToMany('App\Element');
    }

    public function occurrence_id()
    {
        return $this->belongsToMany('App\Occurrence');
    }

    public function elements()
    {
        return Element::pluck('name', 'id');
    }

    public function element_name()
    {
        return Element::find($this->element_id)->name;
    }

}

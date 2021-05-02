<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    
    public function getCompleteAttribute()
    {
        return $this->users->contains(auth()->user()->id);
    }

    //RELACION UNO A UNO
    //*
    public function description(){
        return $this->hasOne('App\Models\Description');
    }
    
    //RELACION UNO A MUCHOS INVERSA
    //*
    public function section(){
        return $this->belongsTo('App\Models\Section');
    }

    //*
    public function platform(){
        return $this->belongsTo('App\Models\Platform');
    }

    //relacion muchos a muchos
    //*
    public function users(){
        return $this->belongsToMany('App\Models\User');
    }

    //RELACION UNO A UNO POLIMORFICA
    //* 
    public function resource(){
        return $this->morphOne('App\Models\Resource', 'resourceable');
    }

    //RELACION UNO A MUCHOS POLIMORFICA
    //*
    public function comments(){
        return $this->morphMany('App\Models\Comment', 'commentable');
    }
    //*
    public function reactions(){
        return $this->morphMany('App\Models\Reaction', 'reactionable');
    }
}

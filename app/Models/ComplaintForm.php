<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Property;
use App\Models\User;


class ComplaintForm extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function property(){
        return $this->belongsTo(Property::class,'property_id','id');
    }

     public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function agent(){
        return $this->belongsTo(User::class, 'agent_id', 'id');
    }

}

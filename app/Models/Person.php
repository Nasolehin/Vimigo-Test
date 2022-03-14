<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'person';
    use HasFactory;
    protected $fillable = [
        'user_id','name', 'email'
    ]; 
    protected $hidden = [
        'created_at', 'updated_at', 'user_id', 'id'
    ]; 
}

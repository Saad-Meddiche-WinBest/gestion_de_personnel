<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employement extends Model
{
    use HasFactory;
    protected $table = 'employements';
    protected $guarded = ['name_of_model', '_token', '_method'];
    protected $fillable = ['nom'];
    
}

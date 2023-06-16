<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poste extends Model
{
    use HasFactory;
    protected $table = 'postes';
    protected $guarded = ['name_of_model', '_token', '_method'];
    protected $fillable = ['nom'];
}

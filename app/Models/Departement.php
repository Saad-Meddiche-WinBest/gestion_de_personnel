<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;
    protected $table = 'departements';
    protected $guarded = ['name_of_model', '_token', '_method'];
    protected $fillable = ['nom'];
}

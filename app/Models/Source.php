<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;
    protected $table = 'sources';
    protected $guarded = ['name_of_model', '_token', '_method'];
    protected $fillable = ['nom','id_poste'];
}

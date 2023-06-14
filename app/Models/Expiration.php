<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expiration extends Model
{
    use HasFactory;
    protected $table = 'expirations';
    protected $guarded = ['name_of_model', '_token', '_method'];
    protected $fillable = ['id_personne', 'date','comment'];
}

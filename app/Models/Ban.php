<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{
    use HasFactory;
    protected $table = 'band';
    protected $guarded = ['name_of_model', '_token', '_method'];
    protected $fillable = ['date', 'reason','nom','prenom','cin'];
}

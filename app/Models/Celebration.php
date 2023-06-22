<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Celebration extends Model
{
    use HasFactory;
    protected $table = 'celibrations';
    protected $guarded = ['name_of_model', '_token', '_method'];
    protected $fillable = ['date', 'evenement'];
}

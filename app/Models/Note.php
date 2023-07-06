<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $table = 'notes';
    protected $guarded = ['name_of_model', '_token', '_method'];
    protected $fillable = ['date', 'block_note'];
}

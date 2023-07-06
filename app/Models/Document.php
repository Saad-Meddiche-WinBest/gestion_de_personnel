<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $table = 'documents';
    protected $guarded = ['name_of_model', '_token', '_method'];
    protected $fillable = ['nom', 'file'];
}

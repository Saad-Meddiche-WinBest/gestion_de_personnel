<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    use HasFactory;
    protected $table = 'icons';
    protected $guarded = ['name_of_model', '_token', '_method'];
    protected $fillable = ['nom'];

    public function poste()
    {
        return $this->belongsTohasOne(Poste::class, 'id_icon');
    }
}

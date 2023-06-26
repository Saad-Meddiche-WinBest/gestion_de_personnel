<?php

namespace App\Models;

use App\Models\Poste;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Source extends Model
{
    use HasFactory;
    protected $table = 'sources';
    protected $guarded = ['name_of_model', '_token', '_method'];
    protected $fillable = ['nom', 'id_poste'];

    public function poste()
    {
        return $this->belongsTo(Poste::class);
    }
}

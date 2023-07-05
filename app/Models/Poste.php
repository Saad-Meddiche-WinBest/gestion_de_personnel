<?php

namespace App\Models;

use App\Models\Icon;
use App\Models\Source;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Poste extends Model
{
    use HasFactory;
    protected $table = 'postes';
    protected $guarded = ['name_of_model', '_token', '_method'];
    protected $fillable = ['nom', 'id_icon'];

    public function sources()
    {
        return $this->hasMany(Source::class, 'id_poste');
    }

    public function icon()
    {
        return $this->belongsTo(Icon::class, 'id_icon');
    }
}

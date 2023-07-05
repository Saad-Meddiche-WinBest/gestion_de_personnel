<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = 'services';
    protected $guarded = ['name_of_model', '_token', '_method'];
    protected $fillable = ['nom' ,'id_departement'];

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personne extends Model
{
    use HasFactory;
    protected $table = 'personnes';
    protected $fillables = ['nom', 'prenom', 'date_naiss', 'adresse', 'telephone', 'email', 'date_debut', 'date_fin', 'cin', 'presence', 'sexe', 'etat_civil', 'id_services', 'id_employement', 'id_source_embauche'];

}

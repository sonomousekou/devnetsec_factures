<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pays extends Model
{
    use HasFactory;

        /**
     * Les attributs assignables.
     *
     * @var array
     */
    protected $fillable = [
        'nom',
        'code_iso', // ISO Alpha-2 (ex. FR, US)
        'indicatif_telephonique', // ex. +33
        'monnaie', // ex. EUR, USD
        'nationalite',
    ];
}

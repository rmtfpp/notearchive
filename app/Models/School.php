<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'json_id',
        'annoscolastico',
        'areageografica',
        'regione',
        'provincia',
        'codiceistitutoriferimento',
        'denominazioneistitutoriferimento',
        'codicescuola',
        'denominazionescuola',
        'indirizzoscuola',
        'capscuola',
        'codicecomunescuola',
        'descrizionec Comune',
        'descrizionecaratteristicascuola',
        'descrizionetipologigradoistruzionescuola',
        'indicazionesededirettivo',
        'indicazionesedeomnicomprensivo',
        'indirizzoemailscuola',
        'indirizzopescuola',
        'sitowebscuola',
        'sedescolastica'
    ];
}


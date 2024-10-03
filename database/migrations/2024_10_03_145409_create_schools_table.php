<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('json_id')->nullable(); 
            $table->integer('annoscolastico');
            $table->string('areageografica');
            $table->integer('capscuola');
            $table->string('codicecomunescuola');
            $table->string('codiceistitutoriferimento');
            $table->string('codicescuola')->unique();
            $table->string('denominazioneistitutoriferimento');
            $table->string('denominazionescuola');
            $table->string('descrizionecaratteristicascuola');
            $table->string('descrizionecComune');
            $table->string('descrizionetipologigradoistruzionescuola');
            $table->boolean('indicazionesededirettivo')->default(false);
            $table->string('indicazionesedeomnicomprensivo')->nullable(); 
            $table->string('indirizzoemailscuola')->nullable();
            $table->string('indirizzoscuola');
            $table->string('provincia');
            $table->string('regione');
            $table->boolean('sedescolastica')->default(false);
            $table->string('sitowebscuola')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('schools');
    }
};

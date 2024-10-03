<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\School;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class SchoolsSeeder extends Seeder
{
    public function run()
    {
        try {
            $json = File::get(storage_path('public/schools.json'));
            
            $schools = json_decode($json, true);

            foreach ($schools['@graph'] as $school) {
                
                $schoolType = $school['miur:DESCRIZIONETIPOLOGIAGRADOISTRUZIONESCUOLA'];

                if ($schoolType === 'SCUOLA PRIMARIA' || $schoolType === 'SCUOLA INFANZIA') {
                    continue; 
                }

                // Insert the school data into the database if it's not excluded
                School::updateOrCreate(
                    ['codicescuola' => $school['miur:CODICESCUOLA']], // Unique field to prevent duplicates
                    [
                        'json_id' => $school['@id'], // Store the @id from JSON
                        'annoscolastico' => $school['miur:ANNOSCOLASTICO'],
                        'areageografica' => $school['miur:AREAGEOGRAFICA'],
                        'capscuola' => is_numeric($school['miur:CAPSCUOLA']) ? (int) $school['miur:CAPSCUOLA'] : 0,
                        'codicecomunescuola' => $school['miur:CODICECOMUNESCUOLA'],
                        'codiceistitutoriferimento' => $school['miur:CODICEISTITUTORIFERIMENTO'],
                        'denominazioneistitutoriferimento' => $school['miur:DENOMINAZIONEISTITUTORIFERIMENTO'],
                        'denominazionescuola' => $school['miur:DENOMINAZIONESCUOLA'],
                        'descrizionecaratteristicascuola' => $school['miur:DESCRIZIONECARATTERISTICASCUOLA'],
                        'descrizionecComune' => $school['miur:DESCRIZIONECOMUNE'],
                        'descrizionetipologigradoistruzionescuola' => $school['miur:DESCRIZIONETIPOLOGIAGRADOISTRUZIONESCUOLA'],
                        'indicazionesededirettivo' => ($school['miur:INDICAZIONESEDEDIRETTIVO'] === "SI"),
                        'indicazionesedeomnicomprensivo' => $school['miur:INDICAZIONESEDEOMNICOMPRENSIVO'],
                        'indirizzoemailscuola' => $school['miur:INDIRIZZOEMAILSCUOLA'] !== "Non Disponibile" ? $school['miur:INDIRIZZOEMAILSCUOLA'] : null,
                        'indirizzoscuola' => $school['miur:INDIRIZZOSCUOLA'],
                        'provincia' => $school['miur:PROVINCIA'],
                        'regione' => $school['miur:REGIONE'],
                        'sedescolastica' => ($school['miur:SEDESCOLASTICA'] === "SI"),
                        'sitowebscuola' => $school['miur:SITOWEBSCUOLA'] !== "Non Disponibile" ? $school['miur:SITOWEBSCUOLA'] : null,
                    ]
                );
            }

            Log::info('School data seeded successfully, excluding SCUOLA PRIMARIA and SCUOLA INFANZIA.');
        } catch (\Exception $e) {
            Log::error('Error seeding school data: ' . $e->getMessage());
        }
    }
}


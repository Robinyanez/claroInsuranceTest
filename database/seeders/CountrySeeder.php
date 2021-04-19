<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use DB;
use Http;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Consumo de servicio para guardar los paises se selecciono solo el pais Ecuador ya que
     * el servicio que se utiliza es gratis y llega a su limite no permite realizar mas consultas
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
            DB::table('countries')->truncate();
        DB::statement("SET foreign_key_checks=1");

        $json = Http::get('https://restcountries.eu/rest/v2/alpha/ec');
        $fulldata = json_decode($json,true);

        Country::create(array(
            'name'  => $fulldata['name'],
            'code'  => $fulldata['alpha2Code'],
            'code2' => $fulldata['alpha3Code'],
        ));
    }
}

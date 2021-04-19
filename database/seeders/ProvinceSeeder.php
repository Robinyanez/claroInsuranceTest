<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\Province;
use DB;
use Http;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Consumo de servicio para guardar las provincias en la tabla mediante la obtención de
     * del pais que corresponde
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
            DB::table('provinces')->truncate();
        DB::statement("SET foreign_key_checks=1");

        $country = Country::select('id','code')->get();
        $country = json_decode($country);

        foreach ($country as $value){

            $json = Http::get('http://www.geonames.org/servlet/geonames?&srv=163&country='.$value->code.'&featureCode=ADM1&lang=en&type=json');
            $fulldata = json_decode($json,true);
            $countryId = $value->id;

            foreach ($fulldata['geonames'] as $key=>$obj){

                Province::create(array(
                    'name'          => $obj['name'],
                    'code'          => $obj['adminCode1'],
                    'country_code'   => $obj['countryCode'],
                    'id_countries'  => $countryId,
                ));
            }
        }

    }
}

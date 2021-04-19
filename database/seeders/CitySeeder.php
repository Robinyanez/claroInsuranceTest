<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;
use App\Models\City;
use DB;
use Http;


class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Consumo de servicio para guardar las ciudades en la tabla mediante la obtención de
     * de la provincia que corresponde
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
            DB::table('cities')->truncate();
        DB::statement("SET foreign_key_checks=1");

        $province = Province::select('id','code','country_code')->get();
        $province = json_decode($province);

        foreach ($province as $value){

            $json = Http::get('http://www.geonames.org/servlet/geonames?&srv=163&country='.$value->country_code.'&adminCode1='.$value->code.'&featureCode=ADM2&lang=en&type=json');
            $fulldata = json_decode($json,true);
            $provinceId = $value->id;

            foreach ($fulldata['geonames'] as $key=>$obj){

                City::create(array(
                    'name'          => $obj['name'],
                    'code'          => $obj['adminCode2'],
                    'code2'          => $obj['adminCode1'],
                    'country_code'   => $obj['countryCode'],
                    'id_provinces'  => $provinceId,
                ));
            }
        }
    }
}

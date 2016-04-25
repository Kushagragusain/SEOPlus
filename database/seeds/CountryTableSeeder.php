<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void


     */

         public function run()

    {
        $country=[


            ['tld' =>'us','country_name' =>'United States',],
            ['tld' =>'au','country_name' =>'Australia',],
            ['tld' =>'br','country_name' =>'Brazil',],
            ['tld' =>'by','country_name' =>'Belarus',],
            ['tld' =>'ca','country_name' =>'Canada',],
            ['tld' =>'ch','country_name' =>'Switzerland',],
            ['tld' =>'cn','country_name' =>'China',],
            ['tld' =>'cz','country_name' =>'Czech Republic',],
            ['tld' =>'fi','country_name' =>'Finland',],
            ['tld' =>'fr','country_name' =>'France',],
            ['tld' =>'ge','country_name' =>'Georgia',],
            ['tld' =>'de','country_name' =>'Germany',],
            ['tld' =>'hk','country_name' =>'Hong Kong',],
            ['tld' =>'in','country_name' =>'India',],
            ['tld' =>'id','country_name' =>'Indonesia',],
            ['tld' =>'iq','country_name' =>'Iraq',],
            ['tld' =>'ie','country_name' =>'Ireland',],
            ['tld' =>'it','country_name' =>'Italy',],
            ['tld' =>'jp','country_name' =>'Japan',],
            ['tld' =>'ru','country_name' =>'Russia',],
            ['tld' =>'kr','country_name' =>'South Korea',],
            ['tld' =>'es','country_name' =>'Spain',],
            ['tld' =>'mx','country_name' =>'Mexico',],
            ['tld' =>'ng','country_name' =>'Nigeria',],
            ['tld' =>'nz','country_name' =>'New Zealand',],
            ['tld' =>'ph','country_name' =>'Philippines',],
            ['tld' =>'sk','country_name' =>'Slovakia',],
            ['tld' =>'th','country_name' =>'Thailand',],
            ['tld' =>'tr','country_name' =>'Turkey',],
            ['tld' =>'ua','country_name' =>'Ukraine',],
            ['tld' =>'uk','country_name' =>'United Kingdom',],
            ['tld' =>'zw','country_name' =>'Zimbabwe',],
        ];

             DB::table('countries')->insert($country);


}
}

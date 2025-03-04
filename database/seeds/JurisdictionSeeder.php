<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Jurisdiction;

class JurisdictionSeeder extends Seeder
{
    public function run()
    {
        $jurisdictions = ['Passenger', 'Staff'];
        foreach ($jurisdictions as $name) {
            Jurisdiction::create(['name' => $name]);
        }
    }
}
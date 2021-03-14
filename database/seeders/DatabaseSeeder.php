<?php

namespace Database\Seeders;

use App\Models\Agence;
use App\Models\Car;
use App\Models\Category;
use App\Models\Component;
use App\Models\ComponentReformation;
use App\Models\Control;
use App\Models\Damage;
use App\Models\Employe;
use App\Models\Extra;
use App\Models\Extrareservation;
use App\Models\Reformation;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Agence::factory(5)->create();
        Category::factory(4)->create();
        User::factory(10)->create();
        Employe::factory(20)->create();
        Car::factory(20)->create();
        Extra::factory(10)->create();
        Reservation::factory(15)->create();
        Extrareservation::factory(20)->create();
        Control::factory(5)->create();
        Damage::factory(10)->create();
        Reformation::factory(40)->create();
        Component::factory(40)->create();
        ComponentReformation::factory(10)->create();











    }
}

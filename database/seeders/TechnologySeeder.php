<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;
class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tech_info = [
            ['name' => 'HTML', 'badge_color' => 'primary'],
            ['name' => 'CSS', 'badge_color' => 'secondary'],
            ['name' => 'Javascript', 'badge_color' => 'success'],
            ['name' => 'PHP', 'badge_color' => 'danger'],
            ['name' => 'VueJs', 'badge_color' => 'warning'],
            ['name' => 'Laravel', 'badge_color' => 'info'],
        ];

        // ciclo l'array di informazioni sulla tecnologia
        foreach ($tech_info as $tech) {
            $technology = new Technology();
            $technology->name = $tech['name'];
            $technology->badge_color = $tech['badge_color'];
            $technology->slug = Str::slug($tech['name'], '-');
            $technology->save();
        }
    }

}

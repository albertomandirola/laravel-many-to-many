<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\Project;


class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 30; $i++) {
            $project = new Project();
            $project->title = $faker->words(3, true);
            $project->description = $faker->text(500);
            $project->link = $faker->url();
            $project->slug = Str::slug($project->title, '-');

            // salvo il record nel database
            $project->save();
        }
    }
}

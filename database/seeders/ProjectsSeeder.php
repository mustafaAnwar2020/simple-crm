<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::factory()->count(25)->create();
    }
}

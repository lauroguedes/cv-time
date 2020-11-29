<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
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
        Category::factory(5)->create();

        User::factory(5)
            ->hasProfile(1)
            ->hasLinks(5)
            ->hasSkills(10)
            ->hasContents(3, new Sequence(
                ['category_id' => 1],
                ['category_id' => 2],
                ['category_id' => 3],
                ['category_id' => 4],
                ['category_id' => 5],
            ))
            ->create();
    }
}

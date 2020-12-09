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
        User::factory(5)
            ->hasProfile(1)
            ->hasLinks(5)
            ->hasSkills(10)
            ->hasEmploymentHistories(5)
            ->create();
    }
}

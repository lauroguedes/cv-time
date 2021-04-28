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
        User::factory()
            ->hasProfile(1)
            ->hasLinks(5)
            ->hasSkills(10)
            ->hasLanguages(2)
            ->hasEmploymentHistories(5)
            ->hasEducation(3)
            ->create([
                'name' => 'Léo WG',
                'email' => 'leo@user.com'
            ]);
    }
}

<?php

declare(strict_types=1);

namespace Database\Seeders;

use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        UserFactory::times(10)->create();
        UserFactory::new()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}

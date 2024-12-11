<?php

namespace Database\Seeders;

use App\Models\BookCategory;
use App\Models\ContactCategory;
use App\Models\Employee;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);

        Employee::create(['name' => 'Ankur Singh']);
        Employee::create(['name' => 'Dikshya Singh']);
        Employee::create(['name' => 'Kshitiz Dahal']);
        Employee::create(['name' => 'Posh Raj Pandey']);
        Employee::create( ['name' => 'Neelu Thapa']);
        Employee::create( ['name' => 'Dhrubesh C. Regmi']);
        Employee::create( ['name' => 'Aayush Paudel']);
        Employee::create( ['name' => 'Rupesh Tha']);
        Employee::create(['name' => 'Manish Dhungana']);
        Employee::create(['name' => 'Paras Kharel']);
        Employee::create(['name' => 'Krishna Tamang']);
        BookCategory::create(['name' => 'N-Book']);
        BookCategory::create(['name' => 'E-Book']);
        BookCategory::create(['name' => 'S-Report']);
        BookCategory::create(['name' => 'O-Report']);
        BookCategory::create(['name' => 'Publication']);
        ContactCategory::create(['name' => 'SAWTEE', 'parent_id' => null]);
        ContactCategory::create(['name' => 'National', 'parent_id' => null]);
        ContactCategory::create(['name' => 'International', 'parent_id' => null]);
    }
}

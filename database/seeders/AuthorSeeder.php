<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::query()->upsert([
            [
                'id'          => 1,
                'name'        => 'Abraham Silberschatz',
                'nationality' => 'Israeli / American',
                'birth_year'  => 1952,
                'fields'      => 'Database Systems, Operating Systems',
            ],
            [
                'id'          => 2,
                'name'        => 'Andrew S. Tanenbaum',
                'nationality' => 'Dutch / American',
                'birth_year'  => 1944,
                'fields'      => 'Distributed Computing, Operating Systems',
            ],
        ], ['id'], ['name', 'nationality', 'birth_year', 'fields']);
    }
}

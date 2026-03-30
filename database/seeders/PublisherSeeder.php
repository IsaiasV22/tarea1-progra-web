<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Publisher::query()->upsert([
            [
                'id'      => 1,
                'name'    => 'John Wiley & Sons',
                'country' => 'United States',
                'founded' => 1807,
                'genre'   => 'Academic',
            ],
            [
                'id'      => 2,
                'name'    => 'Pearson Education',
                'country' => 'United Kingdom',
                'founded' => 1844,
                'genre'   => 'Education',
            ],
        ], ['id'], ['name', 'country', 'founded', 'genre']);
    }
}

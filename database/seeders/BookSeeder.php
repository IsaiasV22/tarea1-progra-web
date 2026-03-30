<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::query()->upsert([
            [
                'id'           => 1,
                'title'        => 'Operating System Concepts',
                'edition'      => '9th',
                'copyright'    => 2012,
                'language'     => 'ENGLISH',
                'pages'        => 976,
                'author_id'    => 1,
                'publisher_id' => 1,
            ],
            [
                'id'           => 2,
                'title'        => 'Database System Concepts',
                'edition'      => '6th',
                'copyright'    => 2010,
                'language'     => 'ENGLISH',
                'pages'        => 1376,
                'author_id'    => 1,
                'publisher_id' => 1,
            ],
            [
                'id'           => 3,
                'title'        => 'Computer Networks',
                'edition'      => '5th',
                'copyright'    => 2010,
                'language'     => 'ENGLISH',
                'pages'        => 960,
                'author_id'    => 2,
                'publisher_id' => 2,
            ],
            [
                'id'           => 4,
                'title'        => 'Modern Operating Systems',
                'edition'      => '4th',
                'copyright'    => 2014,
                'language'     => 'ENGLISH',
                'pages'        => 1136,
                'author_id'    => 2,
                'publisher_id' => 2,
            ],
        ], ['id'], ['title', 'edition', 'copyright', 'language', 'pages', 'author_id', 'publisher_id']);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthorController extends Controller
{
    private function getAuthors(): array
    {
        return [
            [
                'id'          => 1,
                'name'        => 'Abraham Silberschatz',
                'nationality' => 'Israeli / American',
                'birth_year'  => 1952,
                'fields'      => 'Database Systems, Operating Systems',
                'books'       => [
                    ['id' => 1, 'title' => 'Operating System Concepts'],
                    ['id' => 2, 'title' => 'Database System Concepts'],
                ],
            ],
            [
                'id'          => 2,
                'name'        => 'Andrew S. Tanenbaum',
                'nationality' => 'Dutch / American',
                'birth_year'  => 1944,
                'fields'      => 'Distributed Computing, Operating Systems',
                'books'       => [
                    ['id' => 3, 'title' => 'Computer Networks'],
                    ['id' => 4, 'title' => 'Modern Operating Systems'],
                ],
            ],
        ];
    }

    public function index()
    {
        $authors = $this->getAuthors();
        return view('authors.index', compact('authors'));
    }

    public function show(int $id)
    {
        $author = collect($this->getAuthors())->firstWhere('id', $id);
        if (!$author) {
            abort(404, 'Author not found.');
        }
        return view('authors.show', compact('author'));
    }
}

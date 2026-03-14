<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublisherController extends Controller
{
    private function getPublishers(): array
    {
        return [
            [
                'id'      => 1,
                'name'    => 'John Wiley & Sons',
                'country' => 'United States',
                'founded' => 1807,
                'genere'  => 'Academic',
                'books'   => [
                    ['id' => 1, 'title' => 'Operating System Concepts'],
                    ['id' => 2, 'title' => 'Database System Concepts'],
                ],
            ],
            [
                'id'      => 2,
                'name'    => 'Pearson Education',
                'country' => 'United Kingdom',
                'founded' => 1844,
                'genere'  => 'Education',
                'books'   => [
                    ['id' => 3, 'title' => 'Computer Networks'],
                    ['id' => 4, 'title' => 'Modern Operating Systems'],
                ],
            ],
        ];
    }

    public function index()
    {
        $publishers = $this->getPublishers();
        return view('publishers.index', compact('publishers'));
    }

    public function show(int $id)
    {
        $publisher = collect($this->getPublishers())->firstWhere('id', $id);
        if (!$publisher) {
            abort(404, 'Publisher not found.');
        }
        return view('publishers.show', compact('publisher'));
    }
}

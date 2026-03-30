<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function create()
    {
        return view('publishers.create');
    }

    public function store(Request $request)
    {
        $publisher = Publisher::query()->create($request->only([
            'name',
            'country',
            'founded',
            'genre',
        ]));

        return redirect()->route('publishers.show', $publisher->id);
    }

    public function index()
    {
        $publishers = Publisher::query()->orderBy('name')->get();

        return view('publishers.index', compact('publishers'));
    }

    public function edit(int $id)
    {
        $publisher = Publisher::query()->findOrFail($id);

        return view('publishers.edit', compact('publisher'));
    }

    public function update(int $id, Request $request)
    {
        $publisher = Publisher::query()->findOrFail($id);

        $publisher->update($request->only([
            'name',
            'country',
            'founded',
            'genre',
        ]));

        return redirect()->route('publishers.show', $publisher->id);
    }

    public function show(int $id)
    {
        $publisher = Publisher::query()
            ->with('books')
            ->findOrFail($id);

        return view('publishers.show', compact('publisher'));
    }
}

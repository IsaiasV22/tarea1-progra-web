@extends('layouts.app')

@section('title', $publisher->name . ' - Computer Science Books')

@section('content')
<section class="entity-detail">
    <h1>{{ $publisher->name }}</h1>

    <p class="entity-meta">
        Country: {{ $publisher->country }};
        Founded: {{ $publisher->founded }};
        Genre: {{ $publisher->genre }}
    </p>

    <div class="page-actions">
        <a class="btn btn-primary" href="{{ route('publishers.edit', $publisher->id) }}">Edit Publisher</a>
        <a class="btn btn-secondary" href="{{ route('publishers.index') }}">Back to Publishers</a>
    </div>

    <h2>Published Books</h2>
    <ul class="category-list">
        @foreach ($publisher->books as $book)
        <li><a href="{{ route('books.show', $book->id) }}">{{ $book->title }}</a></li>
        @endforeach
    </ul>
</section>
@endsection

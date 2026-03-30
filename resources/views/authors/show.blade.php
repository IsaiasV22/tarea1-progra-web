@extends('layouts.app')

@section('title', $author->name . ' - Computer Science Books')

@section('content')
<section class="entity-detail">
    <h1>{{ $author->name }}</h1>

    <p class="entity-meta">
        Nationality: {{ $author->nationality }};
        Birth Year: {{ $author->birth_year }};
        Fields: {{ $author->fields }}
    </p>

    <div class="page-actions">
        <a class="btn btn-primary" href="{{ route('authors.edit', $author->id) }}">Edit Author</a>
        <a class="btn btn-secondary" href="{{ route('authors.index') }}">Back to Authors</a>
    </div>

    <h2>Published Books</h2>
    <ul class="category-list">
        @foreach ($author->books as $book)
        <li><a href="{{ route('books.show', $book->id) }}">{{ $book->title }}</a></li>
        @endforeach
    </ul>
</section>
@endsection

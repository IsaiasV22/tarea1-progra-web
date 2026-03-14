@extends('layouts.app')

@section('title', $book['title'] . ' - Computer Science Books')

@section('content')
<section class="entity-detail">
    <h1>{{ $book['title'] }}</h1>

    <p class="entity-meta">
        by <a href="{{ route('authors.show', $book['author_id']) }}">{{ $book['author'] }}</a>
        Edition: {{ $book['edition'] }};
        Copyright: {{ $book['copyright'] }};
        Language: {{ $book['language'] }};
        Pages: {{ $book['pages'] }}
        published by <a href="{{ route('publishers.show', $book['publisher_id']) }}">{{ $book['publisher'] }}</a>
    </p>
</section>
@endsection

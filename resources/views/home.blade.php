@extends('layouts.app')

@section('title', 'Computer Science Books')

@section('content')
<section class="home-intro">
    <h1>Computer Science Books</h1>
    <p>
        This website offers information on computer science books, authors and publishers.
    </p>

    <ul class="home-links">
        <li><a href="{{ route('books.index') }}">Books information</a></li>
        <li><a href="{{ route('authors.index') }}">Authors information</a></li>
        <li><a href="{{ route('publishers.index') }}">Publishers information</a></li>
    </ul>
</section>
@endsection

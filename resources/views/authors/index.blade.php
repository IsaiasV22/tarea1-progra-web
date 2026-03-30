@extends('layouts.app')

@section('title', 'Authors - Computer Science Books')

@section('content')
<div class="page-header">
    <h2>Authors Information</h2>
    <p>This section presents information about authors</p>
    <div class="page-actions">
        <a class="btn btn-primary" href="{{ route('authors.create') }}">Add New Author</a>
    </div>
</div>

<ul class="category-list">
    @foreach ($authors as $author)
    <li><a href="{{ route('authors.show', $author->id) }}">{{ $author->name }}</a></li>
    @endforeach
</ul>
@endsection

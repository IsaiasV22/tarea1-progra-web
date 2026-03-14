@extends('layouts.app')

@section('title', 'Books - Computer Science Books')

@section('content')
<div class="page-header">
    <h2>Books Information</h2>
    <p>This section presents information about books</p>
</div>

<ul class="category-list">
    @foreach ($books as $book)
    <li><a href="{{ route('books.show', $book['id']) }}">{{ $book['title'] }}</a></li>
    @endforeach
</ul>
@endsection

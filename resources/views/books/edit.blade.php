@extends('layouts.app')

@section('title', 'Edit Book - Computer Science Books')

@section('content')
<section class="form-page">
    <div class="page-header">
        <h2>Edit Book</h2>
        <p>Update book information</p>
    </div>

    <form class="entity-form" action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input id="title" name="title" type="text" value="{{ old('title', $book->title) }}" required>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="edition">Edition</label>
                <input id="edition" name="edition" type="text" value="{{ old('edition', $book->edition) }}" required>
            </div>

            <div class="form-group">
                <label for="copyright">Copyright</label>
                <input id="copyright" name="copyright" type="number" value="{{ old('copyright', $book->copyright) }}" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="language">Language</label>
                <input id="language" name="language" type="text" value="{{ old('language', $book->language) }}" required>
            </div>

            <div class="form-group">
                <label for="pages">Pages</label>
                <input id="pages" name="pages" type="number" value="{{ old('pages', $book->pages) }}" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="author_id">Author</label>
                <select id="author_id" name="author_id" required>
                    <option value="">Select author</option>
                    @foreach ($authors as $author)
                    <option value="{{ $author->id }}" @selected(old('author_id', $book->author_id) == $author->id)>{{ $author->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="publisher_id">Publisher</label>
                <select id="publisher_id" name="publisher_id" required>
                    <option value="">Select publisher</option>
                    @foreach ($publishers as $publisher)
                    <option value="{{ $publisher->id }}" @selected(old('publisher_id', $book->publisher_id) == $publisher->id)>{{ $publisher->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Book</button>
            <a class="btn btn-secondary" href="{{ route('books.show', $book->id) }}">Cancel</a>
        </div>
    </form>
</section>
@endsection

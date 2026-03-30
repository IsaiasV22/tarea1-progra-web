@extends('layouts.app')

@section('title', 'Edit Author - Computer Science Books')

@section('content')
<section class="form-page">
    <div class="page-header">
        <h2>Edit Author</h2>
        <p>Update author information</p>
    </div>

    <form class="entity-form" action="{{ route('authors.update', $author->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input id="name" name="name" type="text" value="{{ old('name', $author->name) }}" required>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="nationality">Nationality</label>
                <input id="nationality" name="nationality" type="text" value="{{ old('nationality', $author->nationality) }}" required>
            </div>

            <div class="form-group">
                <label for="birth_year">Birth Year</label>
                <input id="birth_year" name="birth_year" type="number" value="{{ old('birth_year', $author->birth_year) }}" required>
            </div>
        </div>

        <div class="form-group">
            <label for="fields">Fields</label>
            <input id="fields" name="fields" type="text" value="{{ old('fields', $author->fields) }}" required>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Author</button>
            <a class="btn btn-secondary" href="{{ route('authors.show', $author->id) }}">Cancel</a>
        </div>
    </form>
</section>
@endsection

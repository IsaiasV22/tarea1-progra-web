@extends('layouts.app')

@section('title', 'Add Author - Computer Science Books')

@section('content')
<section class="form-page">
    <div class="page-header">
        <h2>Add New Author</h2>
        <p>Create a new author entry in the catalog</p>
    </div>

    <form class="entity-form" action="{{ route('authors.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="nationality">Nationality</label>
                <input id="nationality" name="nationality" type="text" value="{{ old('nationality') }}" required>
            </div>

            <div class="form-group">
                <label for="birth_year">Birth Year</label>
                <input id="birth_year" name="birth_year" type="number" value="{{ old('birth_year') }}" required>
            </div>
        </div>

        <div class="form-group">
            <label for="fields">Fields</label>
            <input id="fields" name="fields" type="text" value="{{ old('fields') }}" required>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save Author</button>
            <a class="btn btn-secondary" href="{{ route('authors.index') }}">Cancel</a>
        </div>
    </form>
</section>
@endsection

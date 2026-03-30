@extends('layouts.app')

@section('title', 'Edit Publisher - Computer Science Books')

@section('content')
<section class="form-page">
    <div class="page-header">
        <h2>Edit Publisher</h2>
        <p>Update publisher information</p>
    </div>

    <form class="entity-form" action="{{ route('publishers.update', $publisher->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input id="name" name="name" type="text" value="{{ old('name', $publisher->name) }}" required>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="country">Country</label>
                <input id="country" name="country" type="text" value="{{ old('country', $publisher->country) }}" required>
            </div>

            <div class="form-group">
                <label for="founded">Founded</label>
                <input id="founded" name="founded" type="number" value="{{ old('founded', $publisher->founded) }}" required>
            </div>
        </div>

        <div class="form-group">
            <label for="genre">Genre</label>
            <input id="genre" name="genre" type="text" value="{{ old('genre', $publisher->genre) }}" required>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Publisher</button>
            <a class="btn btn-secondary" href="{{ route('publishers.show', $publisher->id) }}">Cancel</a>
        </div>
    </form>
</section>
@endsection

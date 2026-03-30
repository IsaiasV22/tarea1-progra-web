@extends('layouts.app')

@section('title', 'Add Publisher - Computer Science Books')

@section('content')
<section class="form-page">
    <div class="page-header">
        <h2>Add New Publisher</h2>
        <p>Create a new publisher entry in the catalog</p>
    </div>

    <form class="entity-form" action="{{ route('publishers.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="country">Country</label>
                <input id="country" name="country" type="text" value="{{ old('country') }}" required>
            </div>

            <div class="form-group">
                <label for="founded">Founded</label>
                <input id="founded" name="founded" type="number" value="{{ old('founded') }}" required>
            </div>
        </div>

        <div class="form-group">
            <label for="genre">Genre</label>
            <input id="genre" name="genre" type="text" value="{{ old('genre') }}" required>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save Publisher</button>
            <a class="btn btn-secondary" href="{{ route('publishers.index') }}">Cancel</a>
        </div>
    </form>
</section>
@endsection

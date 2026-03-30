@extends('layouts.app')

@section('title', 'Publishers - Computer Science Books')

@section('content')
<div class="page-header">
    <h2>Publishers Information</h2>
    <p>This section presents information about publishers</p>
    <div class="page-actions">
        <a class="btn btn-primary" href="{{ route('publishers.create') }}">Add New Publisher</a>
    </div>
</div>

<ul class="category-list">
    @foreach ($publishers as $publisher)
    <li><a href="{{ route('publishers.show', $publisher->id) }}">{{ $publisher->name }}</a></li>
    @endforeach
</ul>
@endsection



@extends('Goodi.nav_bar')

@section('main')
    <h1>Create Idea</h1>
    <form action="{{ route('uploadFiles') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <lengend>jgjg</lengend>
        <input type="text" name="title">
        <input type="text" name="description">
        <input type="file" name="pdf[]" multiple>
        <button type="submit">Upload</button>
    </form>
@endsection

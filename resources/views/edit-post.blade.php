@extends('layouts.app')

@section('title')
Tambah Post
@endsection

@push('addons-csd')
@endpush

@section('content')
<div class="card mt-5">
  <div class="card-body">
    <form action="{{ url('/update') }}/{{ $post->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="font-weight-bold">GAMBAR</label>
            <input type="file" class="form-control" name="image">
        </div>
        <div class="form-group">
            <label for="judul">Judul</label>
            <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="judul" value="{{ $post->title }}">
            @error('title')
                <div id="validationServer03Feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
        @enderror
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ $post->description }}</textarea>
            @error('description')
                <div id="validationServer03Feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>


@endsection

@push('addons-js')
@endpush
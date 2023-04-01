@extends('layouts.app')

@section('title')
Tambah Post
@endsection

@push('addons-csd')
@endpush

@section('content')
<div class="card mt-5">
  <div class="card-body">
    <form action="{{ route('tambah.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="font-weight-bold">Gambar</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" >
        
            <!-- error message untuk title -->
            @error('image')
                <div id="validationServer03Feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="judul">Judul</label>
            <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="judul">
            @error('title')
                <div id="validationServer03Feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror"></textarea>
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

<div class="card mt-5">
    <div class="card-header">
        Data post
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($shows as $show)
                    <tr>
                        <th scope="row">{{ $show->id }}</th>
                        <td class="text-center">
                            <img src="{{ Storage::url('public/posts/').$show->image }}" class="rounded" style="width: 150px">
                        </td>
                        <td>{{ $show->title }}</td>
                        <td>{{ $show->description }}</td>
                        <td>
                            <a href="{{ url('/edit') }}/{{ $show -> id }}" class="btn btn-primary">Update</a>
                            <a href="{{ url('/delete') }}/{{ $show -> id }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @empty
                    <div class="alert alert-danger">
                        Data Post belum Tersedia.
                    </div>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('addons-js')
@endpush
@extends('layouts.master')

@section('title')
  <title>Edit Kategori</title>
@endsection

@section('content')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="">Edit Kategori</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Kategori</a></li>
              <li class="breadcrumb-item active">Edit</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            @card
              @slot('title')
                Edit
              @endslot

              @if (session('error'))
                @alert(['type' => 'danger'])
                  {!! session('error') !!}
                @endalert
              @endif

              <form role="form" action="{{ route('categories.update', $category->id) }}" method="post">
                @csrf
                @method('PUT')

                <div class="form-group">
                  <label for="name">Kategori</label>
                  <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ $category->name }}" required>
                </div>

                <div class="form-group">
                  <label for="description">Deskripsi</label>
                  <textarea name="description" id="description" rows="5" cols="5" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ $category->description }}</textarea>
                </div>

                @slot('footer')
                  <div class="card-footer">
                    <button class="btn btn-info">Update</button>
                  </div>
              </form>
                @endslot
            @endcard
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

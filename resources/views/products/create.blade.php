@extends('layouts.master')

@section('title')
  <title>Tambah Data Produk</title>
@endsection

@section('content')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="">Tambah Data</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produk</a></li>
              <li class="breadcrumb-item active">Tambah</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            @card
              @slot('title')

              @endslot

              @if (session('error'))
                @alert(['type' => 'danger'])
                  {!! session('error') !!}
                @endalert
              @endif

              <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                  <label for="">Kode Produk</label>
                  <input type="text" name="code" class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" maxlength="10" required>
                  <p class="text-danger">{{ $errors->first('code') }}</p>
                </div>

                <div class="form-group">
                  <label for="">Nama Produk</label>
                  <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" required>
                  <p class="text-danger">{{ $errors->first('name') }}</p>
                </div>

                <div class="form-group">
                  <label for="">Deskripsi</label>
                  <textarea name="description" rows="5" cols="5" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"></textarea>
                  <p class="text-danger">{{ $errors->first('description') }}</p>
                </div>

                <div class="form-group">
                  <label for="">Stok</label>
                  <input type="number" name="stock" class="form-control {{ $errors->has('stock') ? 'is-invalid' : '' }}" required>
                  <p class="text-danger">{{ $errors->first('stock') }}</p>
                </div>

                <div class="form-group">
                  <label for="">Harga</label>
                  <input type="number" name="price" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" required>
                  <p class="text-danger">{{ $errors->first('price') }}</p>
                </div>

                <div class="form-group">
                  <label for="">Kategori</label>
                  <select class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}" name="category_id" required>
                    <option value="">Pilih</option>
                    @foreach ($categories as $category)
                      <option value="{{ $category->id }}">{{ ucfirst($category->name) }}</option>
                    @endforeach
                  </select>
                  <p class="text-danger">{{ $errors->first('category_id') }}</p>
                </div>

                <div class="form-group">
                  <label for="">Foto</label>
                  <input type="file" name="photo" class="form-control">
                  <p class="text-danger">{{ $errors->first('photo') }}</p>
                </div>

                <div class="form-group">
                  <button class="btn btn-sm btn-primar">
                    <i class="fa fa-send"></i> Simpan
                  </button>
                </div>
              </form>

              @slot('footer')

              @endslot
            @endcard
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

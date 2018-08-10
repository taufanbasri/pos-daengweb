@extends('layouts.master')
​
@section('title')
  <title>Manajemen Produk</title>
@endsection
​
@section('content')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manajemen Produk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Produk</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
​
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            @card
              @slot('title')
                <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary">
                  <i class="fa fa-edit"></i> Tambah
                </a>
              @endslot

              @if (session('success'))
                @alert(['type' => 'success'])
                  {!! session('success') !!}
                @endalert
              @endif

              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama Produk</th>
                      <th>Stok</th>
                      <th>Harga</th>
                      <th>Kategori</th>
                      <th>Last Update</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($products as $product)
                      <tr>
                        <td>
                          @if (!empty($product->photo))
                            <img src="{{ asset('uploads/product/'. $product->photo) }}" alt="{{ $product->photo }}" width="50px" height="50px">
                          @else
                            <img src="http://via.placeholder.com/50x50" alt="{{ $product->name }}">
                          @endif
                        </td>
                        <td>
                          <sup class="label label-success">({{ $product->code }})</sup>
                          <strong>{{ ucfirst($product->name) }}</strong>
                        </td>
                        <td>{{ $product->stock }}</td>
                        <td>Rp {{ number_format($product->price) }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->updated_at }}</td>
                        <td>
                          <form action="{{ route('products.destroy', $product->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">
                              <i class="fa fa-edit"></i>
                            </a>
                            <button class="btn btn-sm btn-danger">
                              <i class="fa fa-trash"></i>
                            </button>
                          </form>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="7" class="text-center">Tidak ada data.</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
              @slot('footer')
              @endslot
            @endcard
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@extends('layouts.master')
​
@section('title')
  <title>Manajemen User</title>
@endsection
​
@section('content')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manajemen User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active">User</li>
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
                <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">Tambah Baru</a>
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
                      <td>#</td>
                      <td>Nama</td>
                      <td>Email</td>
                      <td>Role</td>
                      <td>Status</td>
                      <td>Aksi</td>
                    </tr>
                  </thead>
                  <tbody>
                    @php $no = 1; @endphp
                    @forelse ($users as $user)
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                          @foreach ($user->getRoleNames() as $role)
                            <label class="badge badge-info">{{ $role }}</label>
                          @endforeach
                        </td>
                        <td>
                          @if ($user->status)
                            <label class="badge badge-success">Aktif</label>
                          @else
                            <label class="badge badge-default">Suspend</label>
                          @endif
                        </td>
                        <td>
                          <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('users.roles', $user->id) }}" class="btn btn-sm btn-info">
                              <i class="fa fa-user-secret"></i>
                            </a>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                              <i class="fa fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                          </form>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="6" class="text-center">Tidak ada data</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
              <div class="float-right">
                {!! $users->links() !!}
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

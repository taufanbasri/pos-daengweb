@extends('layouts.master')

@section('title')
  <title>Role Permission</title>
@endsection

@section('css')
  <style type="text/css">
    .tab-pane {
      height: 150px;
      overflow-y: scroll;
    }
  </style>
@endsection

@section('content')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Role Permission</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active">Role Permission</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
​
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
            @card
              @slot('title')
                <h4 class="card-title">Add New Permission</h4>
              @endslot

              <form action="{{ route('users.add-permission') }}" method="post">
                @csrf

                <div class="form-group">
                  <label for="">Name</label>
                  <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">
                  <p class="text-danger">{{ $errors->first('name') }}</p>
                </div>

                <div class="form-group">
                  <button class="btn btn-sm btn-primary">Add New</button>
                </div>
              </form>

              @slot('footer')

              @endslot
            @endcard
          </div>
          <div class="col-md-8">
            @card
              @slot('title')
                Set Permission to Role
              @endslot

              @if (session('success'))
                @alert(['type' => 'success'])
                  {{ session('success') }}
                @endalert
              @endif

              <form action="{{ route('users.roles-permission') }}" method="get">
                <div class="form-group">
                  <label>Roles</label>
                  <div class="input-group">
                    <select class="form-control" name="role">
                      @foreach ($roles as $role)
                        <option value="{{ $role }}">{{ $role }}</option>
                      @endforeach
                    </select>
                    <span class="input-group-btn">
                      <button class="btn btn-danger">Check!</button>
                    </span>
                  </div>
                </div>
              </form>

              @if (!empty($permissions))
                <form action="{{ route('users.set-role-permission', request()->get('role')) }}" method="post">
                  @csrf
                  @method('PUT')

                  <div class="form-group">
                    <div class="nav-tabs-custom">
                      <ul class="nav nav-tabs">
                        <li class="active">
                          <a href="#tab1" data-toggle="tab">Permissions</a>
                        </li>
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                          @php $no = 1; @endphp
                          @foreach ($permissions as $key => $permission)
                            <input type="checkbox" name="permission[]" class="minimal-red" value="{{ $permission }}" {{ in_array($permission, $hasPermissions) ? 'checked' : '' }}> {{  $permission }} <br>

                            @if ($no++%4 == 0)
                              <br>
                            @endif
                          @endforeach
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="pull-right">
                    <button class="btn btn-sm btn-primary">
                      <i class="fa fa-send"></i> Set Permission
                    </button>
                  </div>
                </form>
              @endif
              @slot('footer')

              @endslot
            @endcard
          </div>
        </div>
      </div>
    </section>
</div>
@endsection

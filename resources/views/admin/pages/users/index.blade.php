@extends('admin.layout.app', ['activePage' => 'users', 'title' => 'User Management', 'navName' => 'Users', 'activeButton' => 'laravel'])

@section('content')
<div class="content dashboard">
    @include('admin.pages.components.helper.alert')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header">
                        <div class="row">
                            <h4 class="col card-title">All User</h4>
                            <form class="col-lg-4 col-md-3 col-sm-5" method="" action="" autocomplete="off">
                                <div class="form-group dashboard-search d-flex align-items-center">
                                    <i class="w3-xxlarge nc-icon nc-zoom-split dashboard-search__icon"></i>
                                    <input type="text" id="search" class="form-control dashboard-search__input" placeholder="{{ __('Search') }}" autofocus>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td style="width:30%">{{ $user->name }}</td>
                                    <td style="width:50%">{{ $user->email }}</td>
                                    <td><button type="button" id="btn-delete" data-value="{{$user->id}}" data-toggle="modal" data-target="#delete" class="btn btn-danger">Delete</button></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Delete user</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            Bạn có chắc chắn muốn xóa user này ?
        </div>
        <form action="{{route('admin.user.remove')}}" method="post" class="modal-footer">
            @csrf
            <input type="hidden" id="user-id" name="id" />
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
</div>
@endsection

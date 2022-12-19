@extends('admin.layout.app', ['activePage' => 'blogs', 'title' => 'Blog Management', 'navName' => 'Blogs', 'activeButton' => 'laravel'])

@section('content')
<div class="content dashboard">
    @include('admin.pages.components.helper.alert')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header">
                        <div class="row">
                            <h4 class="col card-title">My Blogs</h4>
                            <form class="col-lg-4 col-md-3 col-sm-5 d-flex mb-1" style="margin-bottom:1rem" method="" action="" autocomplete="off">
                                <a href="{{route('admin.blog.create')}}" class="create-blog-btn btn btn-info btn-fill mr-2">+  Create</a>
                                <div class="form-group dashboard-search d-flex align-items-center">
                                    <i class="w3-xxlarge nc-icon nc-zoom-split dashboard-search__icon"></i>
                                    <input type="text" id="search" class="form-control dashboard-search__input" placeholder="{{ __('Search') }}" autofocus>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <div class="">
                            <a href="{{route('admin.blog')}}" class="btn btn-info ml-2">Pending blogs</a>
                            <a href="" class="btn btn-info btn-fill">My blog</a>
                        </div>
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>Blog</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($blogs as $blog)
                                <tr>
                                    <td style="width:70%">{{ $blog->title }}</td>
                                    <td>
                                        <a href="{{route('admin.blog.update', ['id' => $blog->id])}}" class="btn btn-success btn-fill mr-2">Update</a>
                                        <button type="button" id="btn-delete" data-value="{{$blog->id}}" data-toggle="modal" data-target="#blogDelete" class="btn btn-danger">
                                            Delete
                                        </button>
                                    </td>
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
<div class="modal fade" id="blogDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Delete blog</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            Bạn có chắc chắn muốn xóa blog này ?
        </div>
        <form action="{{route('admin.blog.remove')}}" method="post" class="modal-footer d-flex justify-content-end">
            @csrf
            <input type="hidden" id="id" name="id" />
            <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger btn-fill">Delete</button>
        </form>
      </div>
    </div>
</div>

@endsection

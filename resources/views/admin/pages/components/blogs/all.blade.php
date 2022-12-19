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
                <button type="button" id="btn-blog-approve" data-value="{{$blog->id}}" data-toggle="modal" data-target="#approve" class="btn btn-success btn-fill mr-2">Approve</button>
                <button type="button" id="btn-blog-delete" data-value="{{$blog->id}}" data-toggle="modal" data-target="#delete" class="btn btn-danger">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

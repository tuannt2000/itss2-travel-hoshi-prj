<div class="card mb-4 {{$errors->has('name') || $errors->has('telephone') ? 'd-none' : ''}}" id="profile-info">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-3">
                <p class="mb-0">Name</p>
            </div>
            <div class="col-sm-9">
                <p class="text-muted mb-0">{{ Auth::user()->name }}</p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-3">
                <p class="mb-0">Email</p>
            </div>
            <div class="col-sm-9">
                <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-3">
                <p class="mb-0">Phone</p>
            </div>
            <div class="col-sm-9">
                <p class="text-muted mb-0">{{ Auth::user()->telephone ?? 'Chưa có thông tin' }}</p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-3">
                <p class="mb-0">Address</p>
            </div>
            <div class="col-sm-9">
                <p class="text-muted mb-0">Hà Nội, Việt Nam</p>
            </div>
        </div>
        <div class="row flex-row-reverse">
            <div class="col-sm-2">
                <button type="button" class="btn btn-primary" id="edit">Edit</button>
            </div>
        </div>
    </div>
</div>
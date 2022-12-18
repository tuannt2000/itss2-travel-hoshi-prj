<div class="card mb-4 {{$errors->has('name') || $errors->has('telephone') ? '' : 'd-none'}}" id="profile-edit">
    <form action="" method="post" class="card-body">
        @csrf
        <div class="row">
            <div class="col-sm-3">
                <p class="mb-0">Name</p>
            </div>
            <div class="col-sm-9">
                <input type="text" name="name" class="form-control {{$errors->has('name') ? 'has-error' : ''}}" value="{{Auth::user()->name}}">
                <div class="invalid-feedback">
                    @if($errors->has('name'))
                        {{ $errors->first('name') }}
                    @endif
                </div>
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
                <input type="text" name="telephone" class="form-control {{$errors->has('telephone') ? 'has-error' : ''}}" value="{{Auth::user()->telephone}}">
                <div class="invalid-feedback">
                    @if($errors->has('telephone'))
                        {{ $errors->first('telephone') }}
                    @endif
                </div>
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
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
</div>
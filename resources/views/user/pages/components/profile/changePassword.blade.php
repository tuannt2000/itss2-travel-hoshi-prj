<!-- Modal -->
<div class="modal fade" id="changePassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{route('user.profile.changePassword')}}" method="post" class="modal-content">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Change Password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label>Current Password</label>
                <div class="form-group pass_show"> 
                    <input required min="6" max="8" type="password" name="old_password" class="form-control" placeholder="Current Password"> 
                </div> 
                   <label>New Password</label>
                <div class="form-group pass_show"> 
                    <input required min="6" max="8" type="password" name="new_password" class="form-control" placeholder="New Password"> 
                </div> 
                   <label>Confirm Password</label>
                <div class="form-group pass_show"> 
                    <input required min="6" max="8" type="password" name="confirm_password" class="form-control" placeholder="Confirm Password"> 
                </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
</div>
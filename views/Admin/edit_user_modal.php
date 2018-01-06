<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form>
                <div class="form-group">
                    <input type="text" class="form-control" id="username" placeholder="Username" value="<?= $user['username']; ?>">
                </div>
                <input style="display: none;" hidden type="text" data-userid="<?= $user['id']; ?>" class="form-control" id="userid">
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary save_user_edit">Save changes</button>
        </div>
    </div>
</div>
<?php $this->load->view('Admin/admin_header'); ?>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">


<table id="table_id" class="display">
    <thead>
    <tr>
        <th>Username</th>
        <th>Date Added</th>
        <th>Comments count</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?= $user['username']; ?></td>
        <td><?= $user['date_added']; ?></td>
        <td><?= $user['comments_count']; ?></td>
        <td>
            <!-- <a href="<?= base_url(); ?>admin/user/<?= $user['id']; ?>/update">Update</a> -->
            <button type="button" class="edit_modal btn btn-primary" data-userid="<?= $user['id']; ?>" data-toggle="modal" data-target="#user_edit_modal">
                Edit
            </button>
            <a href="<?= base_url(); ?>admin/users/<?= $user['id']; ?>/pictures">Pictures</a>
            <a href="<?= base_url(); ?>admin/user/<?= $user['id']; ?>/delete">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>



<!-- Modal -->
<div class="modal fade" id="user_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

</div>

<?php $this->load->view('Admin/admin_footer'); ?>
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>



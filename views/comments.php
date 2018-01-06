<table style="width:100%">
    <tr>
        <th>Username</th>
        <th>Comment</th>
    </tr>
    <?php foreach ($comments as $comment): ?>
    <tr>
        <td><?= $comment['username']; ?></td>
        <td><?= $comment['comment_text']; ?></td>
        <?php if($this->session->userdata('user')['role_id'] == 2): ?>
        <td><a href="<?= base_url(); ?>admin/comment/<?= $comment['comment_id']; ?>/delete">Delete</a></td>
        <?php endif; ?>
    </tr>
    <?php endforeach; ?>
</table>

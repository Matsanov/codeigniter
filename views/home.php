<?php
session_start();

//if(!isset($_SESSION['id']))
//{
  //  header("Location: header.php");
//}

$this->db->select('username');
$this->db->from('Users');
$this->db->where('id',$this->session->userdata('username'));
$query = $this->db->get();
$user = $query->row_array();
$this->load->view('header');

?>


<table class="table table-striped">
    <thead>
    <tr>
        <th>Username</th>
        <th>Images Count</th>
        <th>Comments Count</th>
        <th>Date Added</th>
        <th>Image</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['username']; ?></td>
            <td><?= isset($user['images_count']) ? $user['images_count'] : '0'; ?></td>
            <td><?= $user['comments_count']; ?></td>
            <td><?= isset($user['date_added']) ? $user['date_added'] : '-'; ?></td>
            <td><img class="thumbnail img-responsive" width="50" height="50" src="<?= base_url() . 'data/images/' . $user['file_name'] . '' . $user['file_ext'] ?>"></td>
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>

</div>

</body>


</html>
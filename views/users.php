<?php


$this->load->view('header');

?>


<table class="table table-striped">
    <thead>
    <tr>
        <th>Username</th>
        <th>Images Count</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['username']; ?></td>
            <td><?= isset($user['images_count']) ? $user['images_count'] : '0'; ?></td>
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>

</div>

</body>


</html>
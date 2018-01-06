<?php $this->load->view('header'); ?>
<form action="<?= base_url(); ?>image/upload" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="image" id="image">

    <input type="text" name="title" placeholder="Title">
    <input type="text" name="description" placeholder="Description">
    <input type="submit" value="Upload Image" name="submit">
</form>
<?php $this->load->view('footer'); ?>
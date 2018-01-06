<?php $this->load->view('Admin/admin_header'); ?>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/page.css">
    <div class="container">
        <div class="row">
            <h1>Gallery</h1>

            <?php foreach($results as $data): ?>
                <div class="col-lg-3 col-sm-4 col-xs-6 gallery_image" data-username="<?= $data->username; ?>" data-image-id="<?= $data->id;; ?>" >
                    <a description="<?= $data->description; ?>" title="<?= $data->title; ?>"  href="#">
                        <img class="thumbnail img-responsive" src="<?= base_url() . 'data/images/' . $data->file_name . '' . $data->file_ext ?>">
                    </a>
                    <a href="<?= base_url(); ?>admin/users/<?= $data->id; ?>/delete">Delete</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="row" id="alerts">
    </div>
    <div tabindex="-1" class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">×</button>
                    <h2 class="modal-username">Heading</h2>
                    <h3 class="modal-title">Heading</h3>
                </div>
                <div class="modal-body">
                    <div class="image-placeholder"></div>
                    <p class="modal-description"></p>

                    <input name="image_id" value="" id="image_id_modal" hidden>
                    <?php if(!empty($this->session->userdata('user'))): ?>
                        <div id="comment-message" class="form-row">
                            <textarea maxlength="250" name = "comment" placeholder = "Message" id = "comment" ></textarea>
                        </div>
                        <input type="submit" name="submit" id="commentSubmit" value="Submit Comment">
                        <div id="comentsAndUsers"></div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?= $links; ?>

<?php $this->load->view('Admin/admin_footer'); ?>
<?php $this->load->view('header'); ?>

<div class="container">
    <div class="row">
        <h1>Gallery</h1>

        <?php foreach($images as $image): ?>
            <div class="col-lg-3 col-sm-4 col-xs-6 gallery_image" data-image-id="<?= $image['id']; ?>" >
                <a description="<?= $image['description']; ?>" title="<?= $image['title']; ?>" href="#">
                    <img class="thumbnail img-responsive" src="<?= base_url() . 'data/images/' . $image['file_name'] . '' . $image['file_ext'] ?>">
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div tabindex="-1" class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
                <h3 class="modal-title">Heading</h3>
            </div>
            <div class="modal-body">
                <div class="image-placeholder"></div>
                <p class="modal-description"></p>

                <input name="image_id" value="" id="image_id_modal" hidden>
                <div id="comment-message" class="form-row">
                    <textarea maxlength="250" name = "comment" placeholder = "Message" id = "comment" ></textarea>
                </div>
                <input type="submit" name="submit" id="commentSubmit" value="Submit Comment">

                <div id="comentsAndUsers"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('footer'); ?>


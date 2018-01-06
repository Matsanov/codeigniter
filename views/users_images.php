<?php $this->load->view('header'); ?>

    <div class="container">
        <div class="row">
            <h1>Your pictures</h1>

            <?php foreach($images as $image): ?>
                <div class="col-lg-3 col-sm-4 col-xs-6"><a description="<?= $image['description']; ?>" title="<?= $image['title']; ?>" href="#"><img class="thumbnail img-responsive" src="<?= base_url() . 'data/images/' . $image['file_name'] . '' . $image['file_ext'] ?>"></a></div>
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
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php $this->load->view('footer'); ?>
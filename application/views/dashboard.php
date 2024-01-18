  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1 class="m-2"><?= $title ?></h1>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">

      <div class="row">
        <section class="col-lg-12 connectedSortable">
          <?php if ($this->session->flashdata('success')) : ?>
            <div class="alert alert-danger alert-dismissible bg-success text-white border-0 fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <?= $this->session->flashdata('success'); ?>
            </div>
          <?php endif; ?>
          <div class="card">
            <div class="card-body text-center">
              <h4>Welcome <?= $this->session->userdata('nama'); ?> !</h4>
              <h5>Project Material Request </h5>
              <img src="<?php echo base_url() ?>logo.png" class="brand-image">
            </div>
          </div>
      </div>
      </section>
    </div>
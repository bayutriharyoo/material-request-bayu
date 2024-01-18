<div class="content-wrapper">

  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-8">
          <h1 class="m-2 "><?= $title ?></h1>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <form class="form-inline" action="<?php echo base_url(); ?><?= $this->session->role ?>/history" method="post">
            <label for="username" class="col-sm-1 col-form-label">From</label>
            <div class="col-sm-2">
              <input type="date" class="form-control" name="dateFrom">
            </div>
            <label for="username" class="col-sm-1 col-form-label">To</label>
            <div class="col-sm-2">
              <input type="date" class="form-control" name="dateTo">
            </div>
            <div class="col-sm-2">
              <input class="btn btn-primary" type="submit" name="filter" value="Filter">
            </div>
          </form>
          <br>
          <div mb-2>
            <?php if ($this->session->flashdata('message')) :
              echo $this->session->flashdata('message');
            endif; ?>
          </div>
          <div class="table-responsive">
            <table id="tablePengguna" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Material Name</th>
                  <th>Request Qty</th>
                  <th>Date</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th>Reason</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data_history as $row) : ?>
                  <tr>
                    <td><?= $row->material_name ?></td>
                    <td><?= $row->req_qty ?></td>
                    <td><?= date('d F Y', strtotime($row->date)) ?></td>
                    <td><?= $row->desc ?></td>
                    <td><?= $row->status ?></td>
                    <td><?= $row->reason ?></td>
                    <td>
                      <a class="btn btn-primary btn-sm" href="<?= base_url() ?><?= $this->session->role ?>/item/<?= $row->id_material ?>">Detail</a>
                    </td>
                  </tr>
                <?php endforeach; ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
  </section>

</div>
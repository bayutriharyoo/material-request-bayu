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

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form class="form-inline" action="<?php echo base_url(); ?><?= $this->session->role ?>/list" method="post">
                        <?php if ($this->session->role == 'Production') : ?>
                            <a class="btn btn-primary mb-2" data-toggle="modal" data-target="#create-new">+ Create New</a>
                        <?php endif; ?>
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
                                    <!-- <th>Reason</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data_master as $row) : ?>
                                    <tr>
                                        <td><?= $row->material_name ?></td>
                                        <td><?= $row->req_qty ?></td>
                                        <td><?= date('d F Y', strtotime($row->date)) ?></td>
                                        <td><?= $row->desc ?></td>
                                        <td><?= $row->status ?></td>
                                        <!-- <td><?= $row->reason ?></td> -->
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="<?= base_url() ?><?= $this->session->role ?>/item/<?= $row->id_material ?>">Detail</a>
                                            <?php if ($this->session->role == 'Production') : ?>
                                                <?php if ($row->status == 'Entry' || $row->status = 'Waiting') : ?>
                                                    <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit<?= $row->id_material ?>">Edit</a>
                                                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edit<?= $row->id_material ?>" class="modal fade">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="LabelModal">Edit Data Material</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" arial-label="Close">
                                                                        <span arial-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <?php
                                                                    echo form_open_multipart('Production/editMaterial/' . $row->id_material);
                                                                    ?>

                                                                    <div class="form-group row">
                                                                        <label class="col-sm-2 col-form-label">Material Name</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="hidden" class="form-control" name="id_material" value="<?= $row->id_material; ?>">
                                                                            <input type="text" class="form-control" name="material_name" value="<?= $row->material_name; ?>">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label class="col-sm-2 col-form-label">Request Qty</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="number" class="form-control" name="req_qty" value="<?= $row->req_qty; ?>">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label class="col-sm-2 col-form-label">Date</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="date" class="form-control" name="date" value="<?= $row->date; ?>" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label class="col-sm-2 col-form-label">Description</label>
                                                                        <div class="col-sm-10" required>
                                                                            <textarea type="text" class="form-control" name="desc" value="<?= $row->desc; ?>"></textarea>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <div class="col-sm-10 offset-md-2">
                                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancel</button>
                                                                        </div>
                                                                    </div>
                                                                    <?php echo form_close(); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete<?= $row->id_material ?>">Delete</a>
                                                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="Delete<?= $row->id_material ?>" class="modal fade">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="LabelModal">Verification</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" arial-label="Close">
                                                                        <span arial-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <?php
                                                                    echo form_open_multipart('Production/deleteMaterial/' . $row->id_material);
                                                                    ?>

                                                                    <h6>Are You Sure to Delete this Material Request ?</h6>
                                                                    <hr>

                                                                    <div class="form-group row">
                                                                        <div class="col-sm-10">
                                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancel</button>
                                                                        </div>
                                                                    </div>
                                                                    <?php echo form_close(); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif ?>
                                            <?php endif ?>
                                            <?php if ($this->session->role == 'Warehouse') : ?>
                                                <?php if ($row->status == 'Waiting') : ?>
                                                    <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editqty<?= $row->id_material ?>">Edit Qty</a>
                                                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="editqty<?= $row->id_material ?>" class="modal fade">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="LabelModal">Edit Quantity Material</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" arial-label="Close">
                                                                        <span arial-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <?php
                                                                    echo form_open_multipart('Warehouse/editMaterial/' . $row->id_material);
                                                                    ?>

                                                                    <div class="form-group row">
                                                                        <label class="col-sm-2 col-form-label">Material Name</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="hidden" class="form-control" name="id_material" value="<?= $row->id_material; ?>">
                                                                            <input type="text" class="form-control" name="material_name" value="<?= $row->material_name; ?>" readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label class="col-sm-2 col-form-label">Request Qty</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="number" class="form-control" name="req_qty" value="<?= $row->req_qty; ?>">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label class="col-sm-2 col-form-label">Description</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="text" class="form-control" name="desc" value="<?= $row->desc; ?>" readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <div class="col-sm-10 offset-md-2">
                                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancel</button>
                                                                        </div>
                                                                    </div>
                                                                    <?php echo form_close(); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a class="btn btn-success btn-sm" href="<?= base_url() ?>warehouse/approve/<?= $row->id_material ?>">Approve</a>
                                                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#edit<?= $row->id_material ?>">Reject</a>
                                                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edit<?= $row->id_material ?>" class="modal fade">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="LabelModal">Input Reason</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" arial-label="Close">
                                                                        <span arial-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <?php
                                                                    echo form_open_multipart('Warehouse/reject/' . $row->id_material);
                                                                    ?>

                                                                    <div class="form-group row">
                                                                        <label class="col-sm-2 col-form-label">Reason</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="hidden" class="form-control" name="id_material" value="<?= $row->id_material; ?>">
                                                                            <input type="text" class="form-control" name="reason" value="<?= $row->reason; ?>">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <div class="col-sm-10 offset-md-2">
                                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancel</button>
                                                                        </div>
                                                                    </div>
                                                                    <?php echo form_close(); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif ?>
                                            <?php endif ?>
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

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="create-new" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="LabelModal">Create New</h5>
                <button type="button" class="close" data-dismiss="modal" arial-label="Close">
                    <span arial-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                echo form_open_multipart('Production/addMaterial');
                ?>

                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Material Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="material_name" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Request Qty</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="req_qty" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="date" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" name="desc"></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10 offset-md-2">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancel</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModalDelete" tabindex="-1" aria-labelledby="myModalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalDeleteLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this Material data?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btdelete">Yes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<script>
</script>
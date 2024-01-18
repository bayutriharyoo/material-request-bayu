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
                    <?php foreach ($data_master as $row) : ?>
                        <?php if ($this->session->role == 'Production' && $row->status == 'Entry') : ?>
                            <a class="btn btn-primary mb-2" data-toggle="modal" data-target="#create-new">+ Create New</a>
                            <a class="btn btn-success mb-2" href="<?= base_url() ?>/Production/submit/<?= $row->id_material ?>">Submit</a>
                        <?php endif; ?>
                    <?php endforeach ?>
                    <div mb-2>
                        <?php if ($this->session->flashdata('message')) :
                            echo $this->session->flashdata('message');
                        endif; ?>
                    </div>
                    <div class="table-responsive">
                        <table id="tablePengguna" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Qty</th>
                                    <?php if ($row->status == 'Entry' || $row->status == 'Waiting') : ?>
                                        <th>Action</th>
                                    <?php endif ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data_item as $row) : ?>
                                    <tr>
                                        <td><?= $row->item_name ?></td>
                                        <td><?= $row->qty_item ?></td>
                                        <?php if ($this->session->role == 'Production') : ?>
                                            <?php if ($row->status == 'Entry' || $row->status == 'Waiting') : ?>
                                                <td>
                                                    <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit<?= $row->id_item ?>">Edit</a>
                                                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edit<?= $row->id_item ?>" class="modal fade">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="LabelModal">Edit Data Item</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" arial-label="Close">
                                                                        <span arial-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <?php
                                                                    echo form_open_multipart('Production/editItem/' . $row->id_item . '/' . $id_material);
                                                                    ?>

                                                                    <div class="form-group row">
                                                                        <label class="col-sm-2 col-form-label">Item Name</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="hidden" class="form-control" name="id_item" value="<?= $row->id_item; ?>">
                                                                            <input type="text" class="form-control" name="item_name" value="<?= $row->item_name; ?>">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label class="col-sm-2 col-form-label">Qty</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="number" class="form-control" name="qty_item" value="<?= $row->qty_item; ?>">
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
                                                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?= $row->id_item ?>">Delete</a>
                                                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="delete<?= $row->id_item ?>" class="modal fade">
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
                                                                    echo form_open_multipart('Production/deleteItem/' . $row->id_item . '/' . $id_material);
                                                                    ?>

                                                                    <h6>Are You Sure to Delete this Item ?</h6>
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
                                                </td>
                                            <?php endif ?>
                                            <?php if ($this->session->role == 'Warehouse') : ?>
                                                <?php if ($row->status == 'Waiting') : ?>
                                                    <td>
                                                        <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit<?= $row->id_item ?>">Edit Qty</a>
                                                        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edit<?= $row->id_item ?>" class="modal fade">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="LabelModal">Edit Quantity Item</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" arial-label="Close">
                                                                            <span arial-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <?php
                                                                        echo form_open_multipart('Warehouse/editItem/' . $row->id_item . '/' . $id_material);
                                                                        ?>

                                                                        <div class="form-group row">
                                                                            <label class="col-sm-2 col-form-label">Item Name</label>
                                                                            <div class="col-sm-10">
                                                                                <input type="hidden" class="form-control" name="id_item" value="<?= $row->id_item; ?>">
                                                                                <input type="text" class="form-control" name="item_name" value="<?= $row->item_name; ?>" readonly>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group row">
                                                                            <label class="col-sm-2 col-form-label">Qty</label>
                                                                            <div class="col-sm-10">
                                                                                <input type="number" class="form-control" name="qty_item" value="<?= $row->qty_item; ?>">
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
                                                    </td>
                                                <?php endif ?>
                                            <?php endif ?>
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
                echo form_open_multipart('Production/addItem/' . $id_material);
                ?>

                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Item Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="item_name">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Qty</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="qty_item">
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
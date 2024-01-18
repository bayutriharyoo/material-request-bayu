<body style="background-color: grey">
    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 mt-5"></div>
                <div class="col-lg-6 mt-5">

                    <div class="card">
                        <div class="card-body p-4">

                            <h2 class="text-center">Material Request Management System</h2>
                            <hr>


                            <div class="text-center w-75 m-auto" style="color:black;">
                                <h4 class="text-dark-50 text-center mt-0 font-weight-bold">Login</h4>
                                <p class="text-muted mb-4">Please input Username and Password below !
                                </p>
                            </div>
                            <?php if ($this->session->flashdata('error')) : ?>
                                <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <?= $this->session->flashdata('error'); ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($this->session->flashdata('message')) : ?>
                                <?= $this->session->flashdata('message'); ?>
                            <?php endif; ?>

                            <form action="<?= base_url('login/aksi_login'); ?>" method="post">

                                <div class="form-group">
                                    <label style="color:black;">Username</label>
                                    <input class="form-control" type="text" name="username" placeholder="Enter Username">
                                </div>

                                <div class="form-group">
                                    <label for="password" style="color:black;">Password</label>
                                    <input class="form-control" type="password" name="password" placeholder="Password">
                                </div>

                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-primary" type="submit"> Log In </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mt-5"></div>
            </div>
        </div>
    </div>

    <script src="<?= base_url(); ?>assets/js/app.min.js"></script>



</body>

</html>
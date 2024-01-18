  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <link href="<?php echo base_url() ?>fontawesome/css/fontawesome.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo base_url() ?>logo.png">
  </head>

  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand mb-0 h4" href="<?php echo base_url($this->session->userdata('role')) ?>/index">Material Request</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url($this->session->userdata('role')) ?>/index">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url($this->session->userdata('role')) ?>/list">List Material Request</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url($this->session->userdata('role')) ?>/history">History</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
            <a href="<?= base_url('login/logout'); ?>" class="btn btn-outline-danger my-2 my-sm-0">Logout</a>
          </form>
        </div>
      </nav>
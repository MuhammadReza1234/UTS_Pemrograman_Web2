<?php
$session = session();
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top">
  <a class="navbar-brand" href="#">KitaMart</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
    aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <?php if ($session->get('isLoggedIn')): ?>
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="<?= site_url('home/index') ?>">Home <span class="sr-only">(current)</span></a>
        </li>
        <?php if (session()->get('role') == 0): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">Barang</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="<?= site_url('barang/index') ?>">List Barang</a>
              <a class="dropdown-item" href="<?= site_url('barang/create') ?>">Tambah Barang</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('transaksi/index') ?>">Transaksi</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('user/index') ?>">User</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('etalase') ?>">Etalase</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('transaksi/index') ?>">Transaksi</a>
          </li>
        <?php endif ?>
      </ul>
    <?php endif ?>
    <div class="form-inline my-2 my-lg-0">
      <ul class="navbar-nav mr-auto">
        <?php if ($session->get('isLoggedIn')): ?>
          <li class="nav-item">
            <a class="btn btn-primary" href="<?= site_url('auth/logout') ?>">Logout</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="btn btn-primary" href="<?= site_url('auth/login') ?>">Login</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-primary" href="<?= site_url('auth/register') ?>">Register</a>
          </li>
        <?php endif ?>
      </ul>
    </div>
  </div>
</nav>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
  integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
  integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
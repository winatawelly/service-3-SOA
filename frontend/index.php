<?php

  if ($_POST) {

    $method_type = ((isset($_POST['method_type']) && $_POST['method_type'] != '')?$_POST['method_type']:'');

    if ($method_type == 'cari') {
      $username = ((isset($_POST['username']) && $_POST['username'] != '')?$_POST['username']:'');
      header('Location: /soa/frontend/transaction.php?username='.$username);
    }
    else{
      $regMethod = $_SERVER['REQUEST_METHOD'];
      $svcURI = substr_replace($_SERVER['REQUEST_URI'],'/backend/transaction/add/', strlen("/soa"), strlen("/frontend/transaction.php"));

      $id =  substr($_SERVER['REQUEST_URI'], strlen("/soa/frontend/"));

      $username = ((isset($_POST['username']) && $_POST['username'] != '')?$_POST['username']:'');
      $type = ((isset($_POST['type']) && $_POST['type'] != '')?$_POST['type']:'');
      $provider = ((isset($_POST['provider']) && $_POST['provider'] != '')?$_POST['provider']:'');
      $bill_id = ((isset($_POST['bill_id']) && $_POST['bill_id'] != '')?$_POST['bill_id']:'');

      $data = array(
        'username' => $username,
        'type' => $type,
        'provider' => $provider,
        'bill_id' => $bill_id
      );

      $item = json_encode($data);

      $ch = curl_init();

      curl_setopt($ch, CURLOPT_URL, "http://localhost".$svcURI);
      curl_setopt($ch, CURLOPT_HEADER, TRUE);
      curl_setopt($ch, CURLOPT_POST, TRUE);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
      curl_setopt($ch, CURLOPT_POSTFIELDS, $item);

      curl_exec($ch);
      echo $item;
      echo $svcURI;

      curl_close($ch);
      header('Location: /soa/frontend/transaction.php?username='.$username);
    }
  }

 ?>


<?php include 'includes/header.php'; ?>

  <body id="page-top">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">
        <span class="d-block d-lg-none">Start Bootstrap</span>
        <span class="d-none d-lg-block">
          <img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="assets/img/profile.jpg" alt="">
        </span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#about">Cari</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#experience">Tambah</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container-fluid p-0">

      <section class="resume-section p-3 p-lg-5 d-flex d-column" id="about">
        <div class="my-auto">
          <h1 class="mb-0">Cari
            <span class="text-primary">Transaksi</span>
          </h1>
          <div class="" style="margin:10px;">
            <form class="" action="index.php" method="post">
              <div class="form-group row">
                <input type="hidden" name="method_type" value="cari">
                <label for="inputPassword" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputPassword" name="username" placeholder="Masukkan Username">
                </div>
              </div>
              <input type="submit" class="btn btn-primary btn-block" name="" value="cari">
            </form>
          </div>
        </div>
      </section>

      <section class="resume-section p-3 p-lg-5 d-flex flex-column" id="experience">
        <div class="my-auto">
          <h2 class="mb-0">Tambah
            <span class="text-primary">Transaksi</span>
          </h2><br>
          <div class="col-md-6">
            <form class="" action="index.php" method="post">
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputPassword" name="username" placeholder="Masukkan Username">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Tipe</label>
                <div class="col-sm-10">
                <select name ="type" class="form-control">
                  <option value="--">Silahkan Pilih Tipe</option>
                  <option value="internet">Internet</option>
                  <option value="tv">TV</option>
                </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Provider</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputPassword" name="provider" placeholder="Masukkan Provider">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Bill ID</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputPassword" name="bill_id" placeholder="Masukkan Bill ID">
                </div>
              </div>
              <input type="submit" class="btn btn-primary" name="" value="Tambah">
            </form>
          </div>
        </div>

      </section>

    </div>

<?php include 'includes/footer.php'; ?>

<?php

$username = $_GET['username'];

$regMethod = $_SERVER['REQUEST_METHOD'];
$svcURI = substr_replace($_SERVER['REQUEST_URI'],'/backend/transaction/', strlen("/soa"), strlen("/frontend/transaction.php?username="));
$svcURI = $svcURI.'/';


$id =  substr($_SERVER['REQUEST_URI'], strlen("/soa/fronted/"));

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "http://localhost".$svcURI);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

$trans = json_decode(curl_exec($ch),true);

curl_close($ch);

  if ($_POST) {
    $a = substr_replace($_SERVER['REQUEST_URI'],'/backend/transaction/complete', strlen("/soa"), strlen("/frontend/transaction.php?username=".$username));

    $tid = ((isset($_POST['tid']) && $_POST['tid'] != '')?$_POST['tid']:'');
    $user = ((isset($_POST['user']) && $_POST['user'] != '')?$_POST['user']:'');
    $data = array(
      'tid' => $tid,
      'status' => 'completed'
    );


    $item = json_encode($data);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "http://localhost".$a);
    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $item);

    curl_exec($ch);

    curl_close($ch);
    header('Location: /soa/frontend/transaction.php?username='.$user);
  }


?>
<?php include 'includes/header.php'; ?>

  <body id="page-top">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
      <a class="navbar-brand js-scroll-trigger" href="index.php">
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
            <a class="nav-link js-scroll-trigger" href="index.php">Home</a>
          </li>

        </ul>
      </div>
    </nav>

    <div class="container-fluid p-0">
      <section class="resume-section p-3 p-lg-5 d-flex flex-column" id="experience">
        <div class="my-auto">
          <h2 class="mb-0">Detail
            <span class="text-primary">Transaksi</span>
          </h2>
          <?php if ($trans == ''): ?>
            <h1>Error, Data Tidak Ditemukan</h1>
          <?php else:?>
            <div class="col-md-6">
              <table class="table">
                <?php foreach ($trans as $tran): ?>
                  <?php if (isset($trans['code'])): ?>
                    <h2><?=$trans['message'];?></h2>
                    <?php break;?>
                  <?php else:?>
                  <tr>
                      <th>Transaksi ID</th>
                      <td>
                        <?= $tran['transaction_id'];?>
                      </td>
                    </tr>
                    <tr>
                      <th>Username</th>
                      <td>
                        <?= $tran['username'];?>
                      </td>
                    </tr>
                    <tr>
                      <th>Tipe</th>
                      <td>
                        <?= $tran['type'];?>
                      </td>
                    </tr>
                    <tr>
                      <th>Provider</th>
                      <td>
                        <?= $tran['provider'];?>
                      </td>
                    </tr>
                    <tr>
                      <th>Bill ID</th>
                      <td>
                        <?= $tran['bill_id'];?>
                      </td>
                    </tr>
                    <tr>
                      <th>Total</th>
                      <td>
                        <?= $tran['total'];?>
                      </td>
                    </tr>
                    <tr>
                      <th>Bulan</th>
                      <td>
                        <?= $tran['month'];?>
                      </td>
                    </tr>
                    <tr>
                      <th>Tanggal Transaksi</th>
                      <td>
                        <?= $tran['date_made'];?>
                      </td>
                    </tr>
                    <tr>
                      <th>Status</th>
                      <td>
                        <?php if ($tran['status'] == 'pending'): ?>
                          <span style="background-color:yellow;color:black;"><?= $tran['status'];?></span>
                        <?php else:?>
                          <span style="background-color:green;color:white;"><?= $tran['status'];?></span>
                        <?php endif; ?>
                      </td>
                    </tr>
                    <?php if ($tran['status'] == 'pending'): ?>
                      <tr>
                        <td colspan="2">
                          <a href="index.php" class="btn btn-danger">Kembali</a>
                          <form class="" action="transaction.php" method="post">
                            <input type="hidden" name="tid" value="<?= $tran['transaction_id'];?>">
                            <input type="hidden" name="user" value="<?= $tran['username'];?>">
                            <input type="submit" name="" class="btn btn-primary" value="Selesaikan Transaksi">
                          </form>
                        </td>
                      </tr>
                    <?php else:?>
                      <tr>
                        <td colspan="2">
                          <a href="index.php" class="btn btn-danger">Kembali</a>
                        </td>
                      </tr>
                    <?php endif; ?>
                  <?php endif; ?>
                <?php endforeach; ?>
              </table>
            </div>
          <?php endif; ?>
        </div>

      </section>

    </div>

<?php include 'includes/footer.php'; ?>

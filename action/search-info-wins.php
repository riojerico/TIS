<?php
ob_start();
include '../koneksi/koneksi.php';
session_start();

unset($_SESSION['ketemu']);
$no_win = $_POST['win'];
$win = str_replace(" ","",$no_win);
$_SESSION['win']=$win;

if ($_SESSION['level']=='mkt') {
  $link = 'marketing';
}else{
  $link = 'admin-office';
}
// $win = 1385085;
// $comp='MF099';
$order = $conn->query("SELECT id_comp from t4t_order where wins1 <= '$win' and wins2 >= '$win' OR wins1='$win' AND wins2='$win'");
while ($load_order = $order->fetch()) {
  $comp=$load_order['id_comp'];

      $bl = $conn->query("SELECT bl,wins_used from t4t_shipment where id_comp='$comp'");
      // $jml= $conn->query("SELECT count(*) from t4t_shipment where id_comp='MF024'")->fetch();
      while ($load_bl = $bl->fetch()) {

          $cek_bl = $load_bl['bl'];
          // echo "<br>";
              $ambil_bl = $conn->query("SELECT wins_used from t4t_shipment where bl='$cek_bl'")->fetch();
              //echo str_replace(' ','',$ambil_bl[0])."<br><br>";
              echo str_replace(' ','',$ambil_bl[0])."<br><br>";

              $pecah = explode(",", $ambil_bl[0]);
              echo $jml_pecah = count($pecah);

              //jika cuma satu dlm wins used
              if ($win==trim($load_bl['wins_used'])) {
                $_SESSION['ketemu']=$cek_bl;
                header("location:../dashboard/$link.php?cc341787c9dc94e264c6b37728243c42fe9932ba1b1d0d2b903b588d7fd2fb85");
              }else{
                  for ($i=0; $i < $jml_pecah ; $i++) {
                    $pecah[$i]."<br>";
                    $pecah_2 = explode("-", $pecah[$i]);

                    if (isset($pecah_2[1])) {

                      for ($j=trim($pecah_2[0]); $j <= trim($pecah_2[1]) ; $j++) {
                          echo $n = $j." ";
                         if ($j==$win) {
                          "string";
                           $_SESSION['ketemu']=$cek_bl;
                           header("location:../dashboard/$link.php?cc341787c9dc94e264c6b37728243c42fe9932ba1b1d0d2b903b588d7fd2fb85");
                         }
                      }

                    }elseif(trim($pecah_2[0])){
                        $n = trim($pecah_2[0]);

                       if ($n==$win) {
                           "string";
                          $_SESSION['ketemu']=$cek_bl;
                         header("location:../dashboard/$link.php?cc341787c9dc94e264c6b37728243c42fe9932ba1b1d0d2b903b588d7fd2fb85");
                       }
                    }else{
                      header("location:../dashboard/$link.php?cc341787c9dc94e264c6b37728243c42fe9932ba1b1d0d2b903b588d7fd2fb85");
                    }

                  }
                }

      }
}//end while order

      // $ketemu=$_SESSION['ketemu'];
      // if (isset($ketemu)) {
        header("location:../dashboard/$link.php?cc341787c9dc94e264c6b37728243c42fe9932ba1b1d0d2b903b588d7fd2fb85");
      // }


?>

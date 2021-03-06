<?php
$ta_master      = $fc->ta_master($kode_ta);
$kode_kabupaten = $ta_master->kab_code;
$kode_provinsi  = $ta_master->prov_code;
$mu             = $fc->nama_mu($kode_kabupaten,$kode_provinsi);
$kd_mu          = $mu->kd_mu;
$kode_ta;
 ?>
<div class="">

    <div class="page-title">
      <div class="title_left">
        <h3>Planning <small>Data Partisipan</small></h3>
      </div>
      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

        </div>
      </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><i class="fa fa-plus-circle"></i> Input Data Partisipan baru </h2>
            <ul class="nav navbar-right panel_toolbox">
              <a href="?<?php echo paramEncrypt('hal=fc-planning-lihat-data-partisipan')?>" data-toggle="tooltip" data-placement="left" title="Lihat data partisipan"><i class="fa fa-eye"></i> Lihat Data Partisipan</a>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form class="form-horizontal form-label-left" action="" method="post" id="autoForm" enctype='multipart/form-data'>
              <font size="">
              <div class="col-sm-2">

              </div>

              <div class="col-sm-10">
              <!-- desa -->
              <?php
              $_desa=$_REQUEST['desa'];
                $desa2     = $fc->nama_desa($_desa);
                $nama_kec2 = $fc->nama_kec($desa2->id_kec);
                $nama_kab2 = $fc->nama_kab($desa2->kab_code);

               ?>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Desa <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="desa" onchange="this.form.submit()">
                        <option value="<?php echo $_desa ?>"><?php
                        if ($_desa=="") {
                          echo "- Pilih Desa -";
                        }else{
                        echo $desa2->desa.' Kec.'.$nama_kec2->kecamatan.' Kab.'.$nama_kab2->nama;
                        }
                        ?></option>
              <?php

              $sel_desa= $fc->list_desa($kode_fc);

                foreach ($sel_desa as $data_desa) {
                  $id_desa   = $data_desa->id_desa;
                  $nama_desa = $fc->nama_desa($id_desa);

                  $id_kec    = $nama_desa->id_kec;
                  $nama_kec  = $fc->nama_kec($id_kec);

                  $id_kab    = $nama_desa->kab_code;
                  $nama_kab  = $fc->nama_kab($id_kab);

              ?>
                    <option value="<?php echo $id_desa ?>"><?php echo $nama_desa->desa.' Kec.'.$nama_kec->kecamatan.' Kab.'.$nama_kab->nama ?></option>
              <?php
              }
              ?>
                  </select>
                  <noscript><input type="submit" value="desa"></noscript>
                </div>
              </div>
              <!-- no partisipan -->
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">No. Partisipan <span class="required red">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12 font-hijau">
                 <label class="control-label">
                  <?php
                    $no_part = $fc->no_part($_desa);
                    echo $_nopart = $no_part->no+1;
                  ?>
                  </label>
                </div>
              </div>

              </form>

              <div class="ln_solid"></div>

              <?php
              if ($_desa) {
              ?>
              <form action="../action/fc.php" method="post" enctype="multipart/form-data">
                <!-- nama partisipan -->

                <input type="hidden" name="id_desa" value="<?php echo $_desa ?>">
                <input type="hidden" name="no_part" value="<?php echo $_nopart ?>">

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama Partisipan <span class="required red">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" required="required" class="form-control col-md-7 col-xs-12" name="nama" value="<?php echo $nama ?>">
                  </div>
                </div>
                <!-- no ktp -->
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">No. KTP <span class="required red">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" class="form-control input" data-inputmask="'mask' : '999999-999999-9999'" name="ktp" value="<?php echo $ktp ?>" minlength="18">
                    <span class="fa fa-credit-card form-control-feedback right" aria-hidden="true"></span>
                  </div>
                </div>
                <!-- alamat partisipan -->
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Alamat Partisipan <span class="required red">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea type="text" required="required" class="form-control col-md-7 col-xs-12" name="alamat"><?php echo $alamat ?></textarea>
                  </div>
                </div>
                <!-- kelompok tani -->
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kelompok Tani <span class="required red">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control" name="kelompok_tani">
                      <option><?php
                              if ($kelompok_tani=='') {
                                echo "- Kelompok Tani -";
                              }else{
                              echo $kelompok_tani; }
                              ?>
                      </option>

                      <?php
                        $nm_kel_tani = $fc->kel_tani($kd_mu);
                        foreach ($nm_kel_tani as $data_keltani) {

                       ?>
                      <option><?php echo $data_keltani->nama_kel_tani ?></option>
                      <?php
                      }
                       ?>
                    </select>

                  </div>
                </div>
                <!-- keanggotaan dalam kelompok -->
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Keanggotaan Dalam Kelompok <span class="required red">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control" readonly="" name="keanggotaan_kelompok">
                      <option></option>
                    </select>
                  </div>
                </div>
                <!-- jenis kelamin -->
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Jenis Kelamin <span class="required red">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control" name="jenis_kel">
                      <option><?php
                              if ($jenis_kel=='') {
                                echo "- Pilih Jenis Kelamin -";
                              }else{
                              echo $jenis_kel; }
                              ?>
                      </option>
                      <option value="L">Laki-laki</option>
                      <option value="P">Perempuan</option>
                    </select>

                  </div>
                </div>
                <!-- umur -->
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Umur <span class="required red">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="tgl_lahir" required="required" class="form-control col-md-7 col-xs-12" readonly="">
                  </div>
                </div>
                <!-- profesi -->
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Profesi <span class="required red">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control" name="profesi">
                      <option><?php
                              if ($profesi=='') {
                                echo "- Pilih Profesi -";
                              }else{
                              echo $profesi; }
                              ?>
                      </option>
                      <option>Petani</option>
                      <option>Karyawan / Pegawai</option>
                      <option>Wiraswasta / Pedagang</option>
                      <option>Lain-lain</option>

                    </select>

                  </div>
                </div>
                <!-- tujuan menanam pohon -->
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tujuan Menanam Pohon <span class="required red">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control" name="tujuan">
                      <option>- Pilih Tujuan -</option>
                      <option value="Ekonomi">Ekonomi</option>
                      <option value="Lingkungan">Lingkungan</option>
                      <option value="Pendukung">Pendukung</option>
                      <option value="Lainnya">Lainnya</option>
                    </select>
                  </div>
                </div>
                <!-- rencana penebangan -->
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Rencana Penebangan <span class="required red">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control" name="rencana" readonly=" ">
                      <option></option>
                    </select>
                  </div>
                </div>
                <!-- pendapatan / tahun -->
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pendapatan / Tahun <span class="required red">*</span>
                  </label>
                  <div class="col-md-6">
                    <div class="col-md-4">
                    <label class="control-label">1. Petanian</label>
                    </div>
                    <div class="col-md-8">
                    <input type="text" name="pdp_tani" id="angka11" data-affixes-stay="true" data-prefix="Rp. " data-thousands="." data-decimal="," class="form-control col-md-3" value="<?php echo $pendapatan1 ?>"/>
                    </div>
                    <br>

                    <div class="col-md-4">
                    <label class="control-label">2. Perdagangan</label>
                    </div>
                    <div class="col-md-8">
                    <input type="text" name="pdp_dagang" id="angka12" data-affixes-stay="true" data-prefix="Rp. " data-thousands="." data-decimal="," class="form-control col-md-3" value="<?php echo $pendapatan2 ?>"/>
                    </div>
                    <br>

                    <div class="col-md-4">
                    <label class="control-label">3. Pegawai</label>
                    </div>
                    <div class="col-md-8">
                    <input type="text" name="pdp_pegawai" id="angka13" data-affixes-stay="true" data-prefix="Rp. " data-thousands="." data-decimal="," class="form-control col-md-3" value="<?php echo $pendapatan3 ?>"/>
                    </div>
                    <br>

                    <div class="col-md-4">
                    <label class="control-label"> 4. Perkebunan</label>
                    </div>
                    <div class="col-md-8">
                  <input type="text" name="pdp_kebun" id="angka14" data-affixes-stay="true" data-prefix="Rp. " data-thousands="." data-decimal="," class="form-control col-md-3" value="<?php echo $pendapatan4 ?>"/>
                    </div>
                    <br>

                    <div class="col-md-4">
                    <label class="control-label">5. Lainnya</label>
                    </div>
                    <div class="col-md-8">
                    <input type="text" name="pdp_lain" id="angka15" data-affixes-stay="true" data-prefix="Rp. " data-thousands="." data-decimal="," class="form-control col-md-3" value="<?php echo $pendapatan5 ?>"/>
                    </div>

                  </div>
                </div>
                <!-- persepsi tentang t4t -->
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Persepsi Tentang T4T <span class="required red">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="persepsi" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $persepsi ?>">
                  </div>
                </div>
                <!-- foto -->
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Foto <span class="required"></span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" class="form-control" name="files">
                  </div>
                </div>


              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <a href="" class="btn btn-primary">Cancel</a>
                  <button type="submit" name="btn_input_part" class="btn btn-success">Submit</button>
                </div>
              </div>

              </form>
              <?php
              }
              ?>
              </div>

              </font>

          </div>
        </div>
      </div>
    </div>

         <!-- js -->
   </div>

    </div>
    <script src="../js/bootstrap.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="../js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="../js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="../js/icheck/icheck.min.js"></script>
    <script src="../js/custom.js"></script>
    <!-- daterangepicker -->
    <script type="text/javascript" src="../js/moment/moment.min.js"></script>
    <script type="text/javascript" src="../js/datepicker/daterangepicker.js"></script>
    <!-- input mask -->
    <script src="../js/input_mask/jquery.inputmask.js"></script>
    <!-- pace -->
    <script src="../js/pace/pace.min.js"></script>
    <!-- maskmoney -->
    <script src="../js/maskmoney/jquery.maskMoney.min.js"></script>
    <?php for ($i=1; $i <= 5 ; $i++) {  ?>
    <script type="text/javascript">
    $(document).ready(function(){
      $('#angka1<?php echo $i ?>').maskMoney();
      // $('#angka2').maskMoney({prefix:'US$'});
      $('#angka3<?php echo $i ?>').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0});
      // $('#angka4').maskMoney();
    });
    </script>
    <?php } ?>
    <!-- input_mask -->
    <script>
        $(document).ready(function () {
            $("input").inputmask();
        });
    </script>
    <!-- /input mask -->
    <script type="text/javascript" charset="utf-8">
  	function fnHitung() {
  	var angka = bersihPemisah(bersihPemisah(bersihPemisah(bersihPemisah(document.getElementById('inputku').value)))); //input ke dalam angka tanpa titik
  	if (document.getElementById('inputku').value == "") {
  		alert("Jangan Dikosongi");
  		document.getElementById('inputku').focus();
  		return false;
  	}
  	else
  		if (angka >= 1) {
  		alert("angka aslinya : "+angka);
  		document.getElementById('inputku').focus();
  		document.getElementById('inputku').value = tandaPemisahTitik(angka) ;
  		return false;
  		}
  	}
  	</script>

</body>

</html>

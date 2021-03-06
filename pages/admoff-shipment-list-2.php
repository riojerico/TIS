<?php
$kode=$id_member;
$nama_member=$conn->query("SELECT name from t4t_participant where id='$kode'")->fetch();
?>

<div class="">
<div class="page-title">
            <div class="title_left">
              <h3>Shipment<br><small><?php echo $nama_member[0] ?></small></h3>
            </div>
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

              </div>
            </div>
          </div>
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-folder-open"></i> Shipment List <small></small></h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
        <table class="table table-striped responsive-utilities jambo_table" border="1" id="shipmentlist">
          <thead>
            <tr>
              <th width="5%">No.</th>
              <th>Years</th>
            </tr>
          </thead>

          <tbody>
          <?php
          $no=1;
          $member=$conn->query("SELECT substr(wkt_shipment,1,4) as th, no, id_comp from t4t_shipment where id_comp='$kode' group by th order by th desc ");
          while ($data_meber=$member->fetch()) {
            $id_part=$data_meber[2];
            $pil_th =$data_meber[0];
          ?>
            <tr>
              <td align="center"><?php echo $no ?></td>
              <td><a href="?<?php echo paramEncrypt('hal=admoff-shipment-list-detail&id_member='.$id_part.'&pilih_tahun='.$pil_th.'') ?>"><?php echo $data_meber[0] ?></a></td>
            </tr>
          <?php
          $no++;
          } ?>
          </tbody>

        </table>

        </div>
    </div>


<!-- js -->
         </div>

        </div>

        <div id="custom_notifications" class="custom-notifications dsp_none">
            <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
            </ul>
            <div class="clearfix"></div>
            <div id="notif-group" class="tabbed_notifications"></div>
        </div>

        <script src="../js/bootstrap.min.js"></script>

        <!-- chart js -->
        <script src="../js/chartjs/chart.min.js"></script>
        <!-- bootstrap progress js -->
        <script src="../js/progressbar/bootstrap-progressbar.min.js"></script>
        <script src="../js/nicescroll/jquery.nicescroll.min.js"></script>
        <!-- icheck -->
        <script src="../js/icheck/icheck.min.js"></script>

        <script src="../js/custom.js"></script>

        <!-- pace -->
        <script src="../js/pace/pace.min.js"></script>
        <!-- Datatables -->
        <script src="../js/datatables/js/jquery.dataTables.js"></script>
        <script src="../js/datatables/tools/js/dataTables.tableTools.js"></script>

         <script>
          $(function() {
              $('#shipmentlist').DataTable( {
                        // "bJQueryUI":true,
                      "bPaginate":true,
                      "sPaginationType": "full_numbers",
                      "iDisplayLength":10
              } );

          } );
        </script>
        <!-- end datatable -->

</body>

</html>

<!-- Main Footer -->
<footer class="main-footer">
  <!-- To the right -->
  <div class="float-right d-none d-sm-inline">
    PenilaianSiswaSD
  </div>
  <!-- Default to the left -->
  <strong>Copyright &copy; 2022 <a href="#">PenilaianSiswaSD</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script src="../bootstrap-editable.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- Page specific script -->
<script>
$(function(){
    $('.status').editable({
        value: 2,    
        source: [
              {value: 'hadir', text: 'Hadir'},
              {value: 'alfa', text: 'Alfa'},
              {value: 'sakit', text: 'Sakit'},
              {value: 'izin', text: 'Izin'},
           ]
    });
});
</script>
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["csv", "excel"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
<script>
  $(function() {
    bsCustomFileInput.init();
  });
</script>
<!-- <script>
$('body').on('change', '#nama_barang', function() {
$('#nama_barang').val($('#kode_barang option:selected').val());
});
</script> -->
<script type="text/javascript">
  $(document).ready(function() {

    $("#nama_barang").change(function() {
      $.post("display.php", {
          nama_barang: $('#nama_barang option:selected').val()
        },
        function(data, status) {
          $('#kode_barang').val(data);
        });
    });
  });
</script>

</body>

</html>
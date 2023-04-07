 </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<script>
  window.setTimeout(function() {$('.alert').fadeTo(500,0).slideUp(500,function() {
    $(this).remove();
  });
}, 3000);
</script>
<script src="<?= base_url();  ?>template/plugins/moment/moment.min.js"></script>
<script src="<?= base_url();  ?>template/plugins/daterangepicker/daterangepicker.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="<?= base_url();  ?>template/plugins/moment/moment.min.js"></script>
<script src="<?= base_url();  ?>template/plugins/fullcalendar/main.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
  $('#summernote').summernote();
});

</script>
</body>
</html>
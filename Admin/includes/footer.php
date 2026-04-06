      <footer class="footer pt-3  ">
        
      </footer>

      </div>

  </main>



    <!-- Core JS Files  
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="assets/js/plugins/chartjs.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

<script>
  $(document).ready( function () {
    $('#myTable').DataTable();
  });
</script>

<script src="<?= $base_url ?>assets/js/core/popper.min.js"></script>
<script src="<?= $base_url ?>assets/js/core/bootstrap.min.js"></script>
    <!----><script src="<?= $base_url ?>assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="<?= $base_url ?>assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="<?= $base_url ?>assets/js/plugins/chartjs.min.js"></script>

  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->

    <!--<script src="assets/js/soft-ui-dashboard.min.js?v=1.1.0"></script>-->
<script src="<?= $base_url ?>assets/js/soft-ui-dashboard.min.js?v=1.1.0"></script>

</body>

</html>
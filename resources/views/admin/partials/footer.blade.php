
  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>BNB</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Developed by <a>Digital Tranformation Department</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/admin/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/admin/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('assets/admin/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('assets/admin/vendor/quill/quill.js') }}"></script>
  <script src="{{ asset('assets/admin/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('assets/admin/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('assets/admin/vendor/php-email-form/validate.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@if (Session::has('success'))
    <script>
        toastr.success("{{ addslashes(Session::get('success')) }}");
    </script>
@endif

@if(Session::has('error'))
    <script>
        toastr.info("{{ Session::get('error') }}");
    </script>
@endif

@if(Session::has('warning'))
    <script>
        toastr.warning("{{ Session::get('warning') }}");
    </script>
@endif
  <!-- Template Main JS File -->
  <script src="{{ asset('assets/admin/js/main.js') }}"></script>



</body>

</html>
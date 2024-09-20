<footer class="footer">
	
    <div class="container-fluid">
        <div class="divider"></div>
    </div>
    
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-md-left mt-2 mb-3 pt-1">
                <p class="copyright">Copyright &copy; Developed by <a href="https://medialoot.com">BNB</a>.</p>
            </div>
        </div>
    </div>
</footer>					

<!-- Placed at the end of the document so the pages load faster -->
<script src="{{ asset('assets/user/js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('assets/user/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<style>
    #toast-container {
        top: 10px !important; /* Adjust this value as needed */
        left: 50% !important;
        transform: translateX(-50%) !important; /* Remove vertical centering */
        position: fixed !important;
    }
</style>


@if (Session::has('success'))
    <script>
        toastr.success("{{ Session::get('success') }}");
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
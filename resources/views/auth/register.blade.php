@include('user.header.header')
		
		<section class="contact">

			<!--YOU MUST REPLACE WITH YOUR OWN API KEY FOR THE MAP TO WORK-->
			<script async defer
				src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBptaDKT_ntSoNEytCnSang5JenaNAj_Us&callback=initMap">
			</script>
			<div class="container">
				<div class="row contact-details">
					<div class="col-sm-8 text-center text-md-left">
						<h3 class="mb-4">Register</h3>
						<!-- <p class="mb-4">Pay Nu.300 as a entry fee to participate bidding.</p> -->
						<form class="contact-form mt-4" method="POST" action="{{ route('register') }}">
                            @csrf
							<div class="row">
								<div class="col-md-5">
									<input type="text" class="form-control mb-4" placeholder="Name" name="name" value="">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-5">
									<input type="text" class="form-control mb-4" placeholder="CID number" name="cid" value="">
                                    @error('cid')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
								<div class="col-md-5">
									<input type="email" class="form-control mb-4" placeholder="Email address" name="email" value="">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- <div class="col-md-5">
									<input type="tel" class="form-control mb-4" placeholder="Phone" value="">
								</div> -->
                                <div class="col-md-5">
									<input type="password" id="password" name="password" required autocomplete="new-password" 
                                    class="form-control mb-4" placeholder="Password" value="">
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-5">
									<input type="password" id="passsword_confirmation" name="password_confirmation" required
                                     autocomplete="new-password" class="form-control mb-4" placeholder="Confirm Password" value="">
                                     @error('password_confirmation')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
								<br />
							</div>
							<div class="row">
								<div class="col-md-2">
									<button type="submit" class="btn btn-outline-primary btn-lg mb-4">Register</button>
								</div>
                        
							</div>
                            <div class="col-md-5"><span>Already have an account? <a href="{{route  ('login') }}"> Click here</a> </span></div>
						</form>
					</div>
				</div>
			</div>
		</section>
		
		@include('user.footer.footer')
	</body>
</html>

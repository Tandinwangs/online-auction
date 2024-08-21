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
									<select name="dzongcode" id="dzongcode" class="form-control mb-4">
										<option >Choose Dzongkhag</option>
										@foreach($dzongkhags as $dzongkhag)
											<option value="{{ $dzongkhag->dzongcode }}">{{ $dzongkhag->dzongname }}</option>
										@endforeach
										@error('dzongkhag')
											<small class="text-danger">{{ $message }}</small>
										@enderror
									</select>
                                </div>

								<div class="col-md-5">
									<select name="gewocode" id="gewogcode" class="form-control mb-4">
										<option >Choose Gewog</option>
										@error('gewocode')
											<small class="text-danger">{{ $message }}</small>
										@enderror	
									</select>
                                </div>

								<div class="col-md-5">
									<select name="villcode" id="villcode" class="form-control mb-4">
										<option >Choose Village</option>
										@error('villcode')
											<small class="text-danger">{{ $message }}</small>
										@enderror
									</select>
                                </div>

								<div class="col-md-5">
									<input type="text" class="form-control mb-4" placeholder="Phone Number" name="phone_number" value="">
                                    @error('phone_number')
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



<script>
    document.getElementById('dzongcode').addEventListener('change', function () {
        const selectedDzongcode = this.value;
        console.log('dzongcode', selectedDzongcode);

        fetch('/get-gewogs/' + selectedDzongcode)
            .then(response => response.json())
            .then(data => {
                const gewogSelect = document.getElementById('gewogcode');

                gewogSelect.innerHTML = '';
                const defaultOption = document.createElement('option');
                defaultOption.text = 'Choose Gewog';
                defaultOption.disabled = true;
                defaultOption.selected = true;
                gewogSelect.appendChild(defaultOption);

                data.forEach(gewog => {
                    const option = document.createElement('option');
                    option.value = gewog.gewogcode;
                    option.text = gewog.gewogname;
                    gewogSelect.appendChild(option);
                });

                gewogSelect.style.display = 'block';
            })
            .catch(error => {
                console.error('Error fetching gewogs:', error);
            });
    });
</script>

<script>
    $(document).ready(function() {
        // Your existing code for dzongcode and gewogcode

        // Add an event listener for gewogcode select
        $('#gewogcode').on('change', function() {
            const selectedGewogcode = $(this).val();
            // console.log('gewogcode', selectedGewogcode);

            // Make an AJAX request to fetch villages associated with the selected gewogcode
            fetch('/get-villages/' + selectedGewogcode)
                .then(response => response.json())
                .then(data => {
					// console.log('Fetched villages data:', data);  
                    const villageSelect = document.getElementById('villcode');
					
                    villageSelect.innerHTML = '';
                    const defaultOption = document.createElement('option');
                    defaultOption.text = 'Choose Village';
                    defaultOption.disabled = true;
                    defaultOption.selected = true;
                    villageSelect.appendChild(defaultOption);

                      // Check if data is iterable before using forEach
					  if (Array.isArray(data)) {
                        data.forEach(village => {
                            const option = document.createElement('option');
                            option.value = village.villcode;
                            option.text = village.villname;
                            villageSelect.appendChild(option);
                        });
                    } else {
                        console.error('Data is not an array:', data);
                    }


                    villageSelect.style.display = 'block';
                })
                .catch(error => {
                    console.error('Error fetching villages:', error);
                });
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

	
		@include('user.footer.footer')
	</body>
</html>

@include('user.header.header')
		
		<section class="contact">

			<!--YOU MUST REPLACE WITH YOUR OWN API KEY FOR THE MAP TO WORK-->
			<script async defer
				src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBptaDKT_ntSoNEytCnSang5JenaNAj_Us&callback=initMap">
			</script>
			<div class="container">
				<div class="row contact-details">
					<div class="col-sm-8 text-center text-md-left">
						<h3 class="mb-4">Log in</h3>
						<p class="mb-4">Use a local account to log in.</p>
						<form class="contact-form mt-4"  method="POST" action="{{ route('login') }}">
                            @csrf
							<div class="row">
                                <div class="col-md-5">
									<input type="email" name="email" required autofocus autocomplete="username" 
                                    class="form-control mb-4" placeholder="Email"  value="">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
								</div>
                                <div class="col-md-5">
									<input type="password" id="password" name="password"  required 
                                    autocomplete="current-password" class="form-control mb-4" placeholder="Password" value="">
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
								</div>
								<br />
							</div>
							<div class="row">
								<div class="col-md-12"> 
                                <div >
                                    <label for="remember_me" class="inline-flex items-center">
                                        <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                                    </label>
                                </div>

									<button type="submit" class="btn btn-outline-primary btn-lg mb-4">{{ __('Log in') }}</button>
								</div>
                        
							</div>


                    <div class="col-md-5"><span>
                    @if (Route::has('password.request'))    
                    <a href="{{ route('password.request') }}">  
                        {{ __('Forgot your password?') }}
                    </a> </span></div>
                    @endif
                        <div class="col-md-5"><span>Register as a new user? <a href="{{ route('register') }}"> Click here</a> </span></div>
						</form>
					</div>

				</div>
			</div>
		</section>
		
        @include('user.footer.footer')
        
	</body>
</html>
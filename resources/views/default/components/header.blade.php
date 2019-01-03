	<!-- banner -->
	<div class="banner">
		<!-- header -->
		<div class="header">
			<div class="container">
				<div class="menu">
					<a href="#" class="navicon"></a> 
					<div class="toggle">
						<ul class="toggle-menu">
							<li><a href="index.html" class="active"> Home</a></li>
							<li><a href="#about" class="scroll"> About</a></li>
							<li><a href="#gallery" class="scroll"> Gallery</a></li>
							<li><a href="#clients" class="scroll">Clients</a></li>
							<li><a href="#services" class="scroll">Services</a></li>
							<li><a href="#team" class="scroll">Team</a></li>
							<li><a href="#contact" class="scroll"> Contact Us</a></li>
						</ul>
					</div> 
				</div> 
				<div class="logo">
					<h3>
							<img class="logo-inverse" src="https://livedemo00.template-help.com/wt_prod-2269/images/logo-inverse-270x70.png" alt="" width="270" height="70">
					</h3>
				</div> 
				<div class="clearfix"> </div>
			</div>
		</div>
		<!-- //header -->
		<!-- banner-text -->
		<div class="banner-text"> 
			<div class="container">
				<div class="flexslider">
					<ul class="slides">
						<li>
							<div class="banner-w3lstext">
								<h3>Enhancing the Health</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer gravida mauris non mi gravida.</p>
							</div>
						</li>
						<li>
							<div class="banner-w3lstext">
								<h3>build love</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer gravida mauris non mi gravida.</p>
							</div>
						</li>
						<li>
							<div class="banner-w3lstext">
								<h3>give love</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer gravida mauris non mi gravida.</p>
							</div>
						</li>
					</ul> 
				</div> 	
			
				<!-- FlexSlider --> 
				  <script defer src="{{url('vendor/node_modules/new_front_template/js/jquery.flexslider.js')}}"></script>
					<script type="text/javascript">
					$(window).load(function(){
					  $('.flexslider').flexslider({
						animation: "slide",
						start: function(slider){
						  $('body').removeClass('loading');
						}
					  });
					});
				  </script>
				<!-- End-slider-script -->
			</div>
		</div>
		<!-- //banner-text -->
	</div>
	<!-- //banner -->
	<!-- menu-js -->
	<script>
		$('.navicon').on('click', function (e) {
		  e.preventDefault();
		  $(this).toggleClass('navicon--active');
		  $('.toggle').toggleClass('toggle--active');
		});
	</script>
	<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-36251023-1']);
		_gaq.push(['_setDomainName', 'jqueryscript.net']);
		_gaq.push(['_trackPageview']);

		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})(); 
	</script> 
	<!-- //menu-js -->
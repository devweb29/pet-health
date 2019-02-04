
@extends('default.layouts.index')

@push('styles')

@endpush

@push('scripts')

@endpush

@section('title')
Home
@endsection

@section('content')

	<!-- about -->
	<div class="w3ls-about w3ls-section" id="about">
		<div class="container">
			<h3 class="agileits-title">About us</h3>
			<div class="w3-agileits-about-grids">
				<div class="col-md-6 agile-about-left">
					<h2 class="agileits-title">save a pet</h2>
					<h5>PV Animal Shelter is proud to serve the Philippines for everything pet related. Our veterinary clinic network and animal hospital is run by our experienced veterinarian.</h5>
					<p>We're committed to giving your pets extraordinary care whenever and wherever they need it. Partner with one of our veterinarians today to begin proactively monitoring the health and wellness of the pets you love.</p>
					<p>PV Animal Shelter stays on top of the latest advances in veterinarian technology and above all, remembers that all animals and pets need to be treated with loving care.</p>
				</div>
				<div class="col-md-6 agile-about-right"></div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
<!-- //about -->
<!-- adopt -->
	<div class=" w3_agileits-adopt">
		<div class="col-md-3 w3_agileits-adopt-left">
			<img src="{{url('vendor/node_modules/new_front_template/images/p1.png')}}" class="img-responsive" alt=""/>
		</div>
		<div class="col-md-9 w3_agileits-adopt-right">
			<h3 class="w3stitle">A shelter pet wants to meet you</h3> 
			<p>save a life. adopt a shelter pet.</p>
			<img src="{{url('vendor/node_modules/new_front_template/images/cat-nobg.png')}}" class="img-responsive" alt=""/>
		</div>
		<div class="clearfix"></div>
	</div>	
	<!-- //adopt -->
	<!-- gallery -->
	<div class="w3ls-section gallery" id="gallery">	 
		<div class="container">
			<h3 class="agileits-title">Gallery</h3>
			<div class="gallery-info">	
				<div class="col-sm-6 gallery-grids glry-grid1">
					<div class="gallery-grids-top">
						<a class="b-link-stripe b-animate-go" href="{{url('vendor/node_modules/new_front_template/images/g10.jpg')}}" data-lightbox="example-set" data-title="Lorem Ipsum is simply dummy the when an unknown galley of type and scrambled it to make a type specimen book It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. ">
							<img src="{{url('vendor/node_modules/new_front_template/images/g10.jpg')}}" class="img-responsive" alt=""/>
							<div class="b-wrapper">
								<span class="b-animate b-from-left"> 
									<i class="fa fa-arrows-alt" aria-hidden="true"></i>
								</span>					
							</div>
						</a>
					</div>
				</div>
			<div class="col-sm-6  glry-grid2">
					<div class="col-sm-6 col-xs-6 gallery-grids gr1">
						<a class="b-link-stripe b-animate-go" href="{{url('vendor/node_modules/new_front_template/images/g7.jpg')}}" data-lightbox="example-set" data-title="Lorem Ipsum is simply dummy the when an unknown galley of type and scrambled it to make a type specimen book It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. ">
							<img src="{{url('vendor/node_modules/new_front_template/images/g7.jpg')}}" class="img-responsive" alt=""/>
							<div class="b-wrapper">
								<span class="b-animate b-from-left">
									<i class="fa fa-arrows-alt" aria-hidden="true"></i>
								</span>					
							</div>
						</a>
					</div>
					<div class="col-sm-6 col-xs-6 gallery-grids gr3">
						<a class="b-link-stripe b-animate-go" href="{{url('vendor/node_modules/new_front_template/images/g4.jpg')}}" data-lightbox="example-set" data-title="Lorem Ipsum is simply dummy the when an unknown galley of type and scrambled it to make a type specimen book It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. ">
							<img src="{{url('vendor/node_modules/new_front_template/images/g4.jpg')}}" class="img-responsive" alt=""/>
							<div class="b-wrapper">
								<span class="b-animate b-from-left">
									<i class="fa fa-arrows-alt" aria-hidden="true"></i>
								</span>					
							</div>
						</a>
					</div>	
					<div class="col-sm-6 col-xs-6 gallery-grids ">
						<a class="b-link-stripe b-animate-go" href="{{url('vendor/node_modules/new_front_template/images/2.jpg')}}" data-lightbox="example-set" data-title="Lorem Ipsum is simply dummy the when an unknown galley of type and scrambled it to make a type specimen book It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. ">
							<img src="{{url('vendor/node_modules/new_front_template/images/2.jpg')}}" class="img-responsive" alt=""/>
							<div class="b-wrapper">
								<span class="b-animate b-from-left">
									<i class="fa fa-arrows-alt" aria-hidden="true"></i>
								</span>					
							</div>
						</a>
					</div>
					<div class="col-sm-6 col-xs-6 gallery-grids gr3">
						<a class="b-link-stripe b-animate-go" href="{{url('vendor/node_modules/new_front_template/images/g8.jpg')}}" data-lightbox="example-set" data-title="Lorem Ipsum is simply dummy the when an unknown galley of type and scrambled it to make a type specimen book It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. ">
							<img src="{{url('vendor/node_modules/new_front_template/images/g8.jpg')}}" class="img-responsive" alt=""/>
							<div class="b-wrapper">
								<span class="b-animate b-from-left">
									<i class="fa fa-arrows-alt" aria-hidden="true"></i>
								</span>					
							</div>
						</a>
					</div>	
				<div class="clearfix"></div>
				<div class="gallery-grid-3">
					<div class="col-sm-4 col-xs-4 gallery-grids">
						<a class="b-link-stripe b-animate-go" href="{{url('vendor/node_modules/new_front_template/images/s6.jpg')}}" data-lightbox="example-set" data-title="Lorem Ipsum is simply dummy the when an unknown galley of type and scrambled it to make a type specimen book It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. ">
							<img src="{{url('vendor/node_modules/new_front_template/images/s6.jpg')}}" class="img-responsive" alt=""/>
							<div class="b-wrapper">
								<span class="b-animate b-from-left">
									<i class="fa fa-arrows-alt" aria-hidden="true"></i>
								</span>					
							</div>
						</a>
					</div>
					<div class="col-sm-4 col-xs-4 gallery-grids">
						<a class="b-link-stripe b-animate-go" href="{{url('vendor/node_modules/new_front_template/images/g7.jpg')}}" data-lightbox="example-set" data-title="Lorem Ipsum is simply dummy the when an unknown galley of type and scrambled it to make a type specimen book It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. ">
							<img src="{{url('vendor/node_modules/new_front_template/images/g7.jpg')}}" class="img-responsive" alt=""/>
							<div class="b-wrapper">
								<span class="b-animate b-from-left">
									<i class="fa fa-arrows-alt" aria-hidden="true"></i>
								</span>					
							</div>
						</a>
					</div>
					<div class="col-sm-4 col-xs-4 gallery-grids">
						<a class="b-link-stripe b-animate-go" href="{{url('vendor/node_modules/new_front_template/images/g4.jpg')}}" data-lightbox="example-set" data-title="Lorem Ipsum is simply dummy the when an unknown galley of type and scrambled it to make a type specimen book It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. ">
							<img src="{{url('vendor/node_modules/new_front_template/images/g4.jpg')}}" class="img-responsive" alt=""/>
							<div class="b-wrapper">
								<span class="b-animate b-from-left">
									<i class="fa fa-arrows-alt" aria-hidden="true"></i>
								</span>					
							</div>
						</a>
					</div>
					<div class="clearfix"></div>	
				</div>
				<div class="clearfix"></div>
			</div>
				
				
			</div>	
		</div>	
				
	</div>
	<script src="{{url('vendor/node_modules/new_front_template/js/lightbox-plus-jquery.min.js')}}"></script>
	<!-- //gallery -->

<!-- section -->
	<div class="agileits-section w3ls-section text-center">
		<div class="container">
			<h3 class="h3-w3l">Money can buy you a fine dog, but only love can make him wag his tail.</h3>
		</div>
	</div>	
	<!-- //section -->
<!--- breeds -->
	<div class="breeds w3ls-section">
		<div class="container">
			<h3 class="agileits-title">New breeds</h3>   
			<div class="col-md-6 w3lsbreeds-grid">
				<div class="breeds-left"> 
					<div class="wthree-almub">  
					</div>
				</div>
				<div class="breeds-right">
					<h4>Dolor Sit</h4>
					<p>Nsatolernatur auts oditaut miertase vertas.Measnseqe ustur magni dolores eoqus ratione voluptate.</p>
					<a class="w3more" href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-mail-forward" aria-hidden="true"></i> More</a>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="col-md-6 w3lsbreeds-grid">
				<div class="breeds-left"> 
					<div class="wthree-almub wthree-almub2"> 
					</div> 
				</div>
				<div class="breeds-right">
					<h4>Consequat</h4>
					<p>Nsatolernatur auts oditaut miertase vertas.Measnseqe ustur magni dolores eoqus ratione voluptate.</p>
					<a class="w3more" href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-mail-forward" aria-hidden="true"></i> More</a>
				</div>
				<div class="clearfix"></div>
			</div>  
			<div class="col-md-6 w3lsbreeds-grid">
				<div class="breeds1-right"> 
					<div class="wthree-almub wthree-almub3">  
					</div>
				</div>
				<div class="breeds1-left">
					<h4>Dolores Btrs</h4>
					<p>Nsatolernatur auts oditaut miertase vertas.Measnseqe ustur magni dolores eoqus ratione voluptate.</p>
					<a class="w3more" href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-mail-forward" aria-hidden="true"></i> More</a>
				</div> 
				<div class="clearfix"></div>
			</div>
			<div class="col-md-6 w3lsbreeds-grid">
				<div class="breeds1-right"> 
					<div class="wthree-almub wthree-almub4">  
					</div>
				</div>
				<div class="breeds1-left">
					<h4>Nam aliquam</h4>
					<p>Nsatolernatur auts oditaut miertase vertas.Measnseqe ustur magni dolores eoqus ratione voluptate.</p>
					<a class="w3more" href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-mail-forward" aria-hidden="true"></i> More</a>
				</div> 
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div> 
		</div>
	</div>
	<!--- //breeds --> 
	<!--testimonial-->
	<div id="clients" class="w3ls-section testimonial">
		<h3 class="agileits-title">happy clients gallery</h3>   
		<div class="testi-left">
			<div class="testi-left-info">
				<script>
					// You can also use "$(window).load(function() {"
					$(function () {
					  // Slideshow 2
					  $("#slider2").responsiveSlides({
						auto: true,
						pager: true,
						nav: false,
						speed: 500,
						namespace: "callbacks",
						before: function () {
						  $('.events').append("<li>before event fired.</li>");
						},
						after: function () {
						  $('.events').append("<li>after event fired.</li>");
						}
					  });
				
					});
				</script>
				<!--//End-slider-script-->
				<div  id="top2" class="callbacks_container">
					<ul class="rslides" id="slider2">
						<li>
							<div class="col-md-5 client-img c1">
								
							</div>	
							<div class="col-md-7 client-text">
								<h3>Iileen -</h3>
								<h4>"Have a friendly vet with a heart.</h4>
								<ul class="social-icons3">
									<li><a href="https://www.facebook.com/pages/Animal-Shelter-Veterinary-Clinic-Taguig-Branch/767435229945215" class="fa fa-facebook icon-border facebook"> </a></li>
									<li><a href="https://www.google.com/search?rlz=1C1CHZL_enPH831PH831&ei=S4dXXN2CCIKuvwSO4JXwDw&q=pv+animal+shelter+taguig&oq=pv+ani&gs_l=psy-ab.3.0.35i39l2j0i203l8.2216.3425..4932...0.0..0.213.1057.0j5j1......0....1..gws-wiz.......0i71j0j0i131j0i67j0i10.DLgfgI5jbQc" class="fa fa-google-plus icon-border googleplus"> </a></li>
								</ul>

							</div>
							<div class="clearfix"></div>
						</li>
						<li>
							<div class="col-md-5 client-img c2">
								
							</div>	
							<div class="col-md-7 client-text">
								<h3>氷 アフロイロ -</h3>
								<h4>"Upgraded Clinic. Was able to get the results in a few minutes. VETS are very approachable and open. Most of all you have a peace of mind when you walk out, knowing your furbaby is safe.</h4>
								<ul class="social-icons3">
									<li><a href="https://www.facebook.com/pages/Animal-Shelter-Veterinary-Clinic-Taguig-Branch/767435229945215" class="fa fa-facebook icon-border facebook"> </a></li>
									<li><a href="https://www.google.com/search?rlz=1C1CHZL_enPH831PH831&ei=S4dXXN2CCIKuvwSO4JXwDw&q=pv+animal+shelter+taguig&oq=pv+ani&gs_l=psy-ab.3.0.35i39l2j0i203l8.2216.3425..4932...0.0..0.213.1057.0j5j1......0....1..gws-wiz.......0i71j0j0i131j0i67j0i10.DLgfgI5jbQc" class="fa fa-google-plus icon-border googleplus"> </a></li>
								</ul>
							</div>
							<div class="clearfix"></div>
						</li>
						<li>
							<div class="col-md-5 client-img c3">
								
							</div>	
							<div class="col-md-7 client-text">
								<h3>Roselle -</h3>
								<h4>"Thanks a lot for taking care of our cookie. very accommodating docs especiallly dra. Salvo as well as all the staff. Very much deserving for a 5 star rating.</h4>
								<ul class="social-icons3">
									<li><a href="https://www.facebook.com/pages/Animal-Shelter-Veterinary-Clinic-Taguig-Branch/767435229945215" class="fa fa-facebook icon-border facebook"> </a></li>
									<li><a href="https://www.google.com/search?rlz=1C1CHZL_enPH831PH831&ei=S4dXXN2CCIKuvwSO4JXwDw&q=pv+animal+shelter+taguig&oq=pv+ani&gs_l=psy-ab.3.0.35i39l2j0i203l8.2216.3425..4932...0.0..0.213.1057.0j5j1......0....1..gws-wiz.......0i71j0j0i131j0i67j0i10.DLgfgI5jbQc" class="fa fa-google-plus icon-border googleplus"> </a></li>
								</ul>

							</div>
							<div class="clearfix"></div>
						</li>
					</ul>
				</div>
			</div>
		</div>
		
		<div class="clearfix"></div>
	</div>
	<!-- //testimonials -->
	<!-- blog -->
	<div id="services" class="w3ls-section wthree-blog">
		<div class="container">  
				<h3 class="agileits-title">Look after your pet</h3>     
			<div class="blog-agileinfo">
				<div class="col-md-3 blog-w3grid-img">
						<img src="{{url('vendor/node_modules/new_front_template/images/s5.jpg')}}" class="img-responsive" alt=""/>
				</div>
				<div class="col-md-9 blog-w3grid-text"> 
					<h4>pet care advice</h4>
					<p>Sed interdum interdum accumsan. Aenean nec purus ac orci finibus facilisis. In sit amet placerat nisl, in auctor sapien. Donec ultricies faucibus ante in mattis earum rerum delectus in auctor sapien. </p>
				</div> 
				<div class="clearfix"> </div>
			</div> 
			<div class="blog-agileinfo blog-agileinfo-mdl">
				<div class="col-md-5 blog-w3grid-img blog-img-rght">
						<img src="{{url('vendor/node_modules/new_front_template/images/s3.jpg')}}" class="img-responsive" alt=""/>
				</div>
				<div class="col-md-7 blog-w3grid-text"> 
					<h4>the groom room</h4>
					<p>Sed interdum interdum accumsan. Aenean nec purus ac orci finibus facilisis. In sit amet placerat nisl, in auctor sapien. Donec ultricies faucibus ante in mattis earum rerum hic a sapiente delectus. </p>
				</div> 
				<div class="clearfix"> </div>
			</div> 
			<div class="blog-agileinfo">
				<div class="col-md-5 blog-w3grid-img">
						<img src="{{url('vendor/node_modules/new_front_template/images/s4.jpg')}}" class="img-responsive" alt=""/>
				</div>
				<div class="col-md-7 blog-w3grid-text"> 
					<h4>Vaccinations</h4>
					<p>Sed interdum interdum accumsan. Aenean nec purus ac orci finibus facilisis. In sit amet placerat nisl, in auctor sapien. Donec ultricies faucibus ante rerum hic a sapiente delectus in auctor sapien. </p>
				</div> 
				<div class="clearfix"> </div>
			</div> 
		</div>
	</div>
	<!-- //blog --> 
	<!-- testimonials -->
	<div class="testimonials w3ls-section" id="team">
		<div class="container">
			<h3 class="agileits-title">Team</h3>
		<div class="w3_testimonials_grids w3_testimonials_grids">
			<div class="sreen-gallery-cursual">
				<div id="owl-demo" class="owl-carousel">
						 <div class="item-owl">
							<div class="col-md-3 col-sm-3 col-xs-3 img-agile">
								<img src="{{url('vendor/node_modules/new_front_template/images/t1.jpg')}}" class="img-responsive" alt=""/>
								<h6>Michael</h6>
							</div>
							<div class="col-md-9 col-sm-9 col-xs-9 test-review test-tooltip1">
								<p><i class="fa fa-quote-left" aria-hidden="true"></i> Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.<i class="fa fa-quote-right" aria-hidden="true"></i> </p>
							</div>
						 </div>
						 <div class="item-owl">
							<div class="col-md-3 col-sm-3 col-xs-3 img-agile">
								<img src="{{url('vendor/node_modules/new_front_template/images/t2.jpg')}}" class="img-responsive" alt=""/>
								<h6>Riya Allen</h6>
							</div>
							<div class="col-md-9 col-sm-9 col-xs-9 test-review test-tooltip1">
								<p> <i class="fa fa-quote-left" aria-hidden="true"></i> Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.<i class="fa fa-quote-right" aria-hidden="true"></i> </p>
							</div>
						</div>
						 <div class="item-owl">
							<div class="col-md-3 col-sm-3 col-xs-3 img-agile">
								<img src="{{url('vendor/node_modules/new_front_template/images/t3.jpg')}}" class="img-responsive" alt=""/>
								<h6>Riya Allen</h6>
							</div>
							<div class="col-md-9 col-sm-9 col-xs-9 test-review test-tooltip1">
								 <p><i class="fa fa-quote-left" aria-hidden="true"></i> Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.<i class="fa fa-quote-right" aria-hidden="true"></i> </p>
							</div>
						</div>
				 </div>
				 <script src="{{url('vendor/node_modules/new_front_template/js/owl.carousel.js')}}"></script>
				 <script>
						 $(document).ready(function() {
						   $("#owl-demo").owlCarousel({
							 items : 1,
							 lazyLoad : true,
							 autoPlay : true,
							 navigation : true,
							 navigationText : true,
							 pagination : true,
						   });
						 });
				 </script>
				<!--//screen-gallery-->
			</div>	
		</div>
	</div>
	</div>
	<!-- //testimonials -->	

@endsection
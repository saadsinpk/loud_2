@extends("web.layouts.app")
@section('content')

	<div id="main-banner" class="banner-one" data-scroll-index="0">
		<div data-src="{{url('public/uploads/web/slide-1.jpg')}}">
			<div class="camera_caption">
				<div class="container">
					<h1 class="wow fadeInUp animated">World is greater than five #ELPolitic</h1>
					<p class="wow fadeInUp animated" data-wow-delay="0.2s">With ELPolitic responsive landing page template, you can showcase your next politics & politician websites!</p>
					<a data-scroll href="#" class="btn btn-light btn-radius btn-brd grd1">Vote</a>
				</div> <!-- /.container -->
			</div> <!-- /.camera_caption -->
		</div>
		<div data-src="{{url('public/uploads/web/slide-2.jpg')}}">
			<div class="camera_caption">
				<div class="container">
					<h1 class="wow fadeInUp animated">World is greater than five #ELPolitic</h1>
					<p class="wow fadeInUp animated" data-wow-delay="0.2s">With ELPolitic responsive landing page template, you can showcase your next politics & politician websites!</p>
					<a data-scroll href="#" class="btn btn-light btn-radius btn-brd grd1">Contact Us</a>
				</div> <!-- /.container -->
			</div> <!-- /.camera_caption -->
		</div>
		<div data-src="{{url('public/uploads/web/slide-3.png')}}">
			<div class="camera_caption">
				<div class="container">
					<h1 class="wow fadeInUp animated">World is greater than five #ELPolitic</h1>
					<p class="wow fadeInUp animated" data-wow-delay="0.2s">With ELPolitic responsive landing page template, you can showcase your next politics & politician websites!</p>
					<a data-scroll href="#" class="btn btn-light btn-radius btn-brd grd1">Vote</a>
				</div> <!-- /.container -->
			</div> <!-- /.camera_caption -->
		</div>
	</div> <!-- /#theme-main-banner -->


    <div id="about" data-scroll-index="1" class="section wb">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="message-box">
                        <h4>Who We are</h4>
                        <h2>Welcome to  ELPolitic</h2>
                        <blockquote class="lead">Quisque eget nisl id nulla sagittis auctor quis id. Aliquam quis vehicula enim, non aliquam risus. Sed a tellus quis mi rhoncus dignissim.</blockquote>

                        <p> Integer rutrum ligula eu dignissim laoreet. Pellentesque venenatis nibh sed tellus faucibus bibendum. Sed fermentum est vitae rhoncus molestie. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed vitae rutrum neque. Ut id erat sit amet libero bibendum aliquam. Donec ac egestas libero, eu bibendum risus. Phasellus et congue justo. </p>

                        <a href="#services" data-scroll class="btn btn-light btn-radius btn-brd grd1">Learn More</a>
                    </div><!-- end messagebox -->
                </div><!-- end col -->

                <div class="col-md-6">
                    <div class=" wow fadeIn wow fadeIn text-center">
                        <img src="{{url('public/uploads/web/AAGAIN_small.png')}}" alt="" class="">
                        <a href="#" data-rel="prettyPhoto[gal]" class="playbutton"><i class="flaticon-play-button"></i></a>
                    </div><!-- end media -->
                </div><!-- end col -->
            </div><!-- end row -->

            <hr class="hr1"> 

            <div class="row text-center">
                <div class="col-md-6 col-sm-6 col-xs-12">
                   <div class="service-widget">
                        <div class="post-media_pp wow fadeIn">
                            <a href="{{url('public/uploads/web/politic_01.jpg')}}" data-rel="prettyPhoto[gal]" class="hoverbutton global-radius"><i class="flaticon-unlink"></i></a>
                            <img src="{{url('public/uploads/web/politic_01.jpg')}}" alt="" class="img-responsive">
							<div class="hover-up">
								<h3>Let's work for a better future</h3>
								<p>Aliquam sagittis ligula et sem lacinia, ut facilisis enim sollicitudin. Proin nisi est, 
								convallis nec purus vitae, iaculis posuere sapien. Cum sociis natoque.</p>
							</div>
                        </div>
                        
                    </div><!-- end service -->
                </div>

				
				
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->

    <div class="section nopad">
        <img src="/" alt="" class="img-responsive">
    </div>

    <div id="issues" data-scroll-index="2" class="section lb">
        <div class="container">
            <div class="section-title text-left">
                <h3>Agents</h3>
                <p class="lead">Quisque eget nisl id nulla sagittis auctor quis id. Aliquam quis vehicula enim, non aliquam risus.<br> Sed a tellus quis mi rhoncus dignissim.</p>
            </div><!-- end title -->

            <div class="row">
				<div class="col-md-6">
                    <div class="issuse-wrap clearfix">
                        <img src="{{url('public/uploads/web/otogg.jpg')}}" alt="" class="img-responsive img-rounded alignleft">
                        <h4>CLIMATE CHANGE</h4>
                        <p>Etiam materials ut mollis tellus, vel posuere nulla. Etiam sit amet massa sodales aliquam at eget quam. Integer ultricies et magna quis.</p>
                    </div><!-- end issue -->

                    <div class="issuse-wrap clearfix">
                        <img src="{{url('public/uploads/web/pdp.jpg')}}" alt="" class="img-responsive img-rounded alignleft">
                        <h4>COMPREHENSIVE IMMIGRATION REFORM</h4>
                        <p>Etiam materials ut mollis tellus, vel posuere nulla. Etiam sit amet lacus vitae massa sodales aliquam at eget quam. Integer ultricies et magna quis.</p>
                    </div><!-- end issue -->

                    <div class="issuse-wrap clearfix">
                        <img src="{{url('public/uploads/web/AAGAIN_small.png')}}" alt="" class="img-responsive img-rounded alignleft">
                        <h4>ECONOMIC OPPORTUNITY</h4>
                        <p>Etiam materials ut mollis tellus, vel posuere nulla. Etiam sit amet lacus vitae massa sodales aliquam at eget quam. Integer ultricies et magna quis.</p>
                    </div><!-- end issue -->

                    <div class="issuse-wrap lastchild clearfix">
                        <img src="{{url('public/uploads/web/wadaaaaro.png')}}" alt="" class="img-responsive img-rounded alignleft">
                        <h4>HEALTH CARE</h4>
                        <p>Etiam materials ut mollis tellus, vel posuere nulla. Etiam sit amet lacus vitae massa sodales aliquam at eget quam. Integer ultricies et magna quis.</p>
                    </div><!-- end issue -->
                </div><!-- end col --> 
                <div class="col-md-6">
                    <div class="issuse-wrap clearfix">
                        <img src="{{url('public/uploads/web/AAGAIN_small.png')}}" alt="" class="img-responsive img-rounded alignleft">
                        <h4>CLIMATE CHANGE</h4>
                        <p>Etiam materials ut mollis tellus, vel posuere nulla. Etiam sit amet massa sodales aliquam at eget quam. Integer ultricies et magna quis.</p>
                    </div><!-- end issue -->

                    <div class="issuse-wrap clearfix">
                        <img src="{{url('public/uploads/web/AAGAIN_small.png')}}" alt="" class="img-responsive img-rounded alignleft">
                        <h4>COMPREHENSIVE IMMIGRATION REFORM</h4>
                        <p>Etiam materials ut mollis tellus, vel posuere nulla. Etiam sit amet lacus vitae massa sodales aliquam at eget quam. Integer ultricies et magna quis.</p>
                    </div><!-- end issue -->

                    <div class="issuse-wrap clearfix">
                        <img src="{{url('public/uploads/web/AAGAIN_small.png')}}" alt="" class="img-responsive img-rounded alignleft">
                        <h4>ECONOMIC OPPORTUNITY</h4>
                        <p>Etiam materials ut mollis tellus, vel posuere nulla. Etiam sit amet lacus vitae massa sodales aliquam at eget quam. Integer ultricies et magna quis.</p>
                    </div><!-- end issue -->

                    <div class="issuse-wrap lastchild clearfix">
                        <img src="{{url('public/uploads/web/AAGAIN_small.png')}}" alt="" class="img-responsive img-rounded alignleft">
                        <h4>HEALTH CARE</h4>
                        <p>Etiam materials ut mollis tellus, vel posuere nulla. Etiam sit amet lacus vitae massa sodales aliquam at eget quam. Integer ultricies et magna quis.</p>
                    </div><!-- end issue -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->

    
	
	<div id="gallery" data-scroll-index="4" class="section lb">
		<div class="container">
			<div class="section-title text-center">
                <h3>Gallery</h3>
                <p class="lead">Quisque eget nisl id nulla sagittis auctor quis id. Aliquam quis vehicula enim, non aliquam risus.<br> Sed a tellus quis mi rhoncus dignissim.</p>
            </div><!-- end title -->
			<!--
			<div class="gallery-menu row">
				<div class="col-md-12">
					<div class="button-group filter-button-group text-center">
						<button class="active" data-filter="*">All</button>
						<button data-filter=".gal_a">Meeting</button>
						<button data-filter=".gal_b">Event</button>
						<button data-filter=".gal_c">Economic</button>
						<button data-filter=".gal_d">Education</button>
					</div>
				</div>
			</div> -->
			
			<div class="gallery-list row">
				<div class="col-md-4 col-sm-6 gallery-grid gal_a gal_b">
					<div class="gallery-single fix">
						<img src="{{url('public/uploads/web/candidate1.jpg')}}" class="img-responsive" alt="Image">
						<div class="img-overlay">
							<a href="{{url('public/uploads/web/candidate1.jpg')}}" data-rel="prettyPhoto[gal]" class="hoverbutton global-radius"><i class="flaticon-unlink"></i></a>
						</div>
					</div>
				</div>
				
				<div class="col-md-4 col-sm-6 gallery-grid gal_c gal_b">
					<div class="gallery-single fix">
						<img src="{{url('public/uploads/web/candidate2.jpg')}}" class="img-responsive" alt="Image">
						<div class="img-overlay">
							<a href="{{url('public/uploads/web/candidate2.jpg')}}" data-rel="prettyPhoto[gal]" class="hoverbutton global-radius"><i class="flaticon-unlink"></i></a>
						</div>
					</div>
				</div>
				
				<div class="col-md-4 col-sm-6 gallery-grid gal_a gal_c">
					<div class="gallery-single fix">
						<img src="{{url('public/uploads/web/wadaaaaro.png')}}" class="img-responsive" alt="Image">
						<div class="img-overlay">
							<a href="{{url('public/uploads/web/wadaaaaro.png')}}" data-rel="prettyPhoto[gal]" class="hoverbutton global-radius"><i class="flaticon-unlink"></i></a>
						</div>
					</div>
				</div>
				
				<div class="col-md-4 col-sm-6 gallery-grid gal_b gal_a">
					<div class="gallery-single fix">
						<img src="{{url('public/uploads/web/pdp.jpg')}}" class="img-responsive" alt="Image">
						<div class="img-overlay">
							<a href="{{url('public/uploads/web/pdp.jpg')}}" data-rel="prettyPhoto[gal]" class="hoverbutton global-radius"><i class="flaticon-unlink"></i></a>
						</div>
					</div>
				</div>
				
				<div class="col-md-4 col-sm-6 gallery-grid gal_a gal_c">
					<div class="gallery-single fix">
						<img src="{{url('public/uploads/web/otogg.jpg')}}" class="img-responsive" alt="Image">
						<div class="img-overlay">
							<a href="{{url('public/uploads/web/otogg.jpg')}}" data-rel="prettyPhoto[gal]" class="hoverbutton global-radius"><i class="flaticon-unlink"></i></a>
						</div>
					</div>
				</div>
				
				<div class="col-md-4 col-sm-6 gallery-grid gal_c gal_d">
					<div class="gallery-single fix">
						<img src="{{url('public/uploads/web/gallery_img-06.jpg')}}" class="img-responsive" alt="Image">
						<div class="img-overlay">
							<a href="{{url('public/uploads/web/gallery_img-06.jpg')}}" data-rel="prettyPhoto[gal]" class="hoverbutton global-radius"><i class="flaticon-unlink"></i></a>
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>

	
	

    <div id="donate" data-scroll-index="7" class="section db">
        <div class="container">
            <div class="section-title text-center">
                <h3>Contact</h3>
                <p class="lead">Quisque eget nisl id nulla sagittis auctor quis id. Aliquam quis vehicula enim, non aliquam risus.<br> Sed a tellus quis mi rhoncus dignissim.</p>
            </div><!-- end title -->

            <div class="row">
                <div class="col-md-12">
                    <div class="contact_form">
                        <div id="message"></div>
                        <form id="contactform" class="row" action="#" name="contactform" method="post">
                            <fieldset class="row-fluid">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Your Email">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Your Phone">
                                </div>
                               
                                
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <textarea class="form-control" name="comments" id="comments" rows="6" placeholder="Message?"></textarea>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-center">
                                    <button type="submit" value="SEND" id="submit" class="btn btn-light btn-radius btn-brd grd1 btn-block">Send</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->

 
@endsection

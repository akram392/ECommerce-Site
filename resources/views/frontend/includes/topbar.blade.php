<header id="header" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyStartAt': 135, 'stickySetTop': '-135px', 'stickyChangeLogo': true}">
	<div class="header-body border-color-primary border-bottom-0 box-shadow-none" data-sticky-header-style="{'minResolution': 0}" data-sticky-header-style-active="{'background-color': '#f7f7f7'}" data-sticky-header-style-deactive="{'background-color': '#FFF'}">
		<div class="header-top header-top-borders">
			<div class="container h-100">
				<div class="header-row h-100">
					<div class="header-column justify-content-start">
						<div class="header-row">
							<nav class="header-nav-top">
								<ul class="nav nav-pills">
									<li class="nav-item nav-item-borders py-2">
										<span class="pl-0"><i class="far fa-dot-circle text-4 text-color-primary" style="top: 1px;"></i> 1234 Street Name, City Name</span>
									</li>
									<li class="nav-item nav-item-borders py-2 d-none d-lg-inline-flex">
										<a href="tel:123-456-7890"><i class="fab fa-whatsapp text-4 text-color-primary" style="top: 0;"></i> 123-456-7890</a>
									</li>
									<li class="nav-item nav-item-borders py-2 d-none d-sm-inline-flex">
										<a href="mailto:mail@domain.com"><i class="far fa-envelope text-4 text-color-primary" style="top: 1px;"></i> mail@domain.com</a>
									</li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="header-column justify-content-end">
						<div class="header-row">
							<nav class="header-nav-top">
								<ul class="nav nav-pills">
									<li class="nav-item nav-item-anim-icon d-none d-md-block">
										<a class="nav-link pl-0" href="about-us.html"><i class="fas fa-angle-right"></i> About Us</a>
									</li>
									<li class="nav-item nav-item-anim-icon d-none d-md-block">
										<a class="nav-link" href="contact-us.html"><i class="fas fa-angle-right"></i> Contact Us</a>
									</li>

                                    {{-- Display your name and other access --}}
                                    @if ( isset(Auth::user()->email) )
                                        <li class="nav-item dropdown nav-item-left-border d-none d-sm-block">
                                            <a class="nav-link" href="{{ route('homepage') }}" role="button" id="dropdownLanguage" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{-- Image --}}
                                                @if ( !is_null( Auth::user()->image ) )
                                                    <img src="{{ asset('images/user/' . Auth::user()->image ) }}" width="25" style="border-radius: 50%" alt="Avater">
                                                @else
                                                    <img src="{{ asset('images/user/default.jpg' ) }}" class="user-img" alt="user avatar">
                                                @endif
                                                {{ Auth::user()->name }}
                                                <i class="fas fa-angle-down"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownLanguage">
                                                <a class="dropdown-item" href="{{ route('customerDashboard') }}">My Dashboard</a>
                                                <a class="dropdown-item" href="{{ route('cart.manage') }}">Order History</a>
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                                        <i class='bx bx-log-out-circle'></i>
                                                        <span>Logout</span>
                                                    </a>
                                                </form>
                                            </div>
                                        </li>
                                    @else
                                        <li class="nav-item nav-item-anim-icon d-none d-md-block">
                                            <a class="nav-link" href="{{ route('userLogin') }}"><i class="fas fa-angle-right"></i> Login / Register</a>
                                        </li>
                                    @endif

								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="header-container container">
			<div class="header-row py-2">
				<div class="header-column">
					<div class="header-row">
						<div class="header-logo">
							<a href="{{ route('homepage') }}">
								<img alt="Porto" width="100" height="48" data-sticky-width="82" data-sticky-height="40" data-sticky-top="84" src="{{ asset('frontend/img/logo.png') }}">
							</a>
						</div>
					</div>
				</div>
				<div class="header-column justify-content-end">
					<div class="header-row">
						<ul class="header-extra-info d-flex align-items-center mr-3">
							<li class="d-none d-sm-inline-flex">
								<div class="header-extra-info-text">
									<label>SEND US AN EMAIL</label>
									<strong><a href="mailto:mail@example.com">MAIL@EXAMPLE.COM</a></strong>
								</div>
							</li>
							<li>
								<div class="header-extra-info-text">
									<label>CALL US NOW</label>
									<strong><a href="tel:8001234567">800-123-4567</a></strong>
								</div>
							</li>
						</ul>
						<div class="header-nav-features">
							<div class="header-nav-feature header-nav-features-cart header-nav-features-cart-big d-inline-flex ml-2" data-sticky-header-style="{'minResolution': 991}" data-sticky-header-style-active="{'top': '78px'}" data-sticky-header-style-deactive="{'top': '0'}">
								<a href="#" class="header-nav-features-toggle">
									<img src="{{ asset('frontend/img/icons/icon-cart-big.svg') }}" height="34" alt="" class="header-nav-top-icon-img">
									<span class="cart-info">
										<span class="cart-qty">
                                            {{ App\Models\Cart::totalItems() }}
                                        </span>
									</span>
								</a>
								<div class="header-nav-features-dropdown" id="headerTopCartDropdown">
									<ol class="mini-products-list">
                                        @foreach ( App\Models\Cart::totalCarts() as $cart )
                                            <li class="item">
                                                <a href="#" title="Camera X1000" class="product-image"><img src="{{ asset('frontend/img/products/product-1.jpg') }}" alt="Camera X1000"></a>
                                                <div class="product-details">
                                                    <p class="product-name">
                                                        <a href="#">{{ $cart->product->title }}</a>
                                                    </p>
                                                    <p class="qty-price">

                                                        {{ $cart->quantity }} X
                                                        @if ( !is_null($cart->product->offer_price) )
                                                            <span class="price">{{ $cart->product->offer_price }} BDT</span>
                                                        @else
                                                            <span class="price">{{ $cart->product->regular_price }} BDT</span>
                                                        @endif

                                                    </p>
                                                    <form action="{{ route('cart.delete', $cart->id) }}" method="POST">
                                                        @csrf

                                                        <button type="submit" title="Remove This Item" class="btn-remove">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </li>
                                        @endforeach
									</ol>
									<div class="totals">
                                        @if ( App\Models\Cart::totalCartAmount() == 0 )
                                        <span class="label">Sorry! No Item Added in Cart.</span>
                                        @else
                                            <span class="label">Total:</span>
                                            <span class="price-total">
                                                <span class="price"> = {{ App\Models\Cart::totalCartAmount() }} BDT</span>
                                            </span>
                                        @endif

									</div>
									<div class="actions">
										<a class="btn btn-dark" href="{{ route('cart.manage') }}">View Cart</a>
										<a class="btn btn-primary" href="{{ route('checkout') }}">Checkout</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

        {{-- Nav Menu Start --}}
		<div class="container">
			<div class="header-nav-bar bg-color-light-scale-1 mb-3 px-3 px-lg-0">
				<div class="header-row">
					<div class="header-column">
						<div class="header-row justify-content-end">
							<div class="header-nav header-nav-links justify-content-start" data-sticky-header-style="{'minResolution': 991}" data-sticky-header-style-active="{'margin-left': '150px'}" data-sticky-header-style-deactive="{'margin-left': '0'}">
								<div class="header-nav-main header-nav-main-square header-nav-main-dropdown-no-borders header-nav-main-dropdown-arrow header-nav-main-effect-3 header-nav-main-sub-effect-1">
									<nav class="collapse">
										<ul class="nav nav-pills" id="mainNav">
											<li class="dropdown">
												<a class="dropdown-item dropdown-toggle" href="{{ route('homepage') }}">
													Home
												</a>
											</li>
                                            <li class="dropdown">
												<a class="dropdown-item dropdown-toggle" href="{{ route('products') }}">
													All Products
												</a>
											</li>
											<li class="dropdown dropdown-mega">
												<a class="dropdown-item dropdown-toggle" href="elements.html">
													All Category
												</a>
												<ul class="dropdown-menu">
													<li>
														<div class="dropdown-mega-content">
															<div class="row">
																<div class="col-lg-3">
																	<span class="dropdown-mega-sub-title">Elements 1</span>
																	<ul class="dropdown-mega-sub-nav">
																		<li><a class="dropdown-item" href="elements-accordions.html">Accordions</a></li>
																		<li><a class="dropdown-item" href="elements-toggles.html">Toggles</a></li>
																		<li><a class="dropdown-item" href="elements-tabs.html">Tabs</a></li>
																		<li><a class="dropdown-item" href="elements-icons.html">Icons</a></li>
																		<li><a class="dropdown-item" href="elements-icon-boxes.html">Icon Boxes</a></li>
																		<li><a class="dropdown-item" href="elements-carousels.html">Carousels</a></li>
																		<li><a class="dropdown-item" href="elements-modals.html">Modals</a></li>
																		<li><a class="dropdown-item" href="elements-lightboxes.html">Lightboxes</a></li>
																		<li><a class="dropdown-item" href="elements-word-rotator.html">Word Rotator</a></li>
																		<li><a class="dropdown-item" href="elements-before-after.html">Before / After</a></li>
																		<li><a class="dropdown-item" href="elements-360-image-viewer.html">360º Image Viewer</a></li>
																	</ul>
																</div>
																<div class="col-lg-3">
																	<span class="dropdown-mega-sub-title">Elements 2</span>
																	<ul class="dropdown-mega-sub-nav">
																		<li><a class="dropdown-item" href="elements-buttons.html">Buttons</a></li>
																		<li><a class="dropdown-item" href="elements-badges.html">Badges</a></li>
																		<li><a class="dropdown-item" href="elements-lists.html">Lists</a></li>
																		<li><a class="dropdown-item" href="elements-cards.html">Cards</a></li>
																		<li><a class="dropdown-item" href="elements-image-gallery.html">Image Gallery</a></li>
																		<li><a class="dropdown-item" href="elements-image-frames.html">Image Frames</a></li>
																		<li><a class="dropdown-item" href="elements-image-hotspots.html">Image Hotspots</a></li>
																		<li><a class="dropdown-item" href="elements-testimonials.html">Testimonials</a></li>
																		<li><a class="dropdown-item" href="elements-blockquotes.html">Blockquotes</a></li>
																		<li><a class="dropdown-item" href="elements-sticky-elements.html">Sticky Elements</a></li>
																	</ul>
																</div>
																<div class="col-lg-3">
																	<span class="dropdown-mega-sub-title">Elements 3</span>
																	<ul class="dropdown-mega-sub-nav">
																		<li><a class="dropdown-item" href="elements-typography.html">Typography</a></li>
																		<li><a class="dropdown-item" href="elements-call-to-action.html">Call to Action</a></li>
																		<li><a class="dropdown-item" href="elements-pricing-tables.html">Pricing Tables</a></li>
																		<li><a class="dropdown-item" href="elements-tables.html">Tables</a></li>
																		<li><a class="dropdown-item" href="elements-progressbars.html">Progress Bars</a></li>
																		<li><a class="dropdown-item" href="elements-process.html">Process</a></li>
																		<li><a class="dropdown-item" href="elements-counters.html">Counters</a></li>
																		<li><a class="dropdown-item" href="elements-countdowns.html">Countdowns</a></li>
																		<li><a class="dropdown-item" href="elements-sections-parallax.html">Sections &amp; Parallax</a></li>
																		<li><a class="dropdown-item" href="elements-tooltips-popovers.html">Tooltips &amp; Popovers</a></li>
																	</ul>
																</div>
																<div class="col-lg-3">
																	<span class="dropdown-mega-sub-title">Elements 4</span>
																	<ul class="dropdown-mega-sub-nav">
																		<li><a class="dropdown-item" href="elements-headings.html">Headings</a></li>
																		<li><a class="dropdown-item" href="elements-dividers.html">Dividers</a></li>
																		<li><a class="dropdown-item" href="elements-animations.html">Animations</a></li>
																		<li><a class="dropdown-item" href="elements-medias.html">Medias</a></li>
																		<li><a class="dropdown-item" href="elements-maps.html">Maps</a></li>
																		<li><a class="dropdown-item" href="elements-arrows.html">Arrows</a></li>
																		<li><a class="dropdown-item" href="elements-star-ratings.html">Star Ratings</a></li>
																		<li><a class="dropdown-item" href="elements-alerts.html">Alerts</a></li>
																		<li><a class="dropdown-item" href="elements-posts.html">Posts</a></li>
																		<li><a class="dropdown-item" href="elements-forms-basic-contact.html">Forms</a></li>
																	</ul>
																</div>
															</div>
														</div>
													</li>
												</ul>
											</li>
                                            <li class="dropdown">
												<a class="dropdown-item dropdown-toggle" href="{{ route('about') }}">
													About Us
												</a>
											</li>
                                            <li class="dropdown">
												<a class="dropdown-item dropdown-toggle" href="{{ route('contact') }}">
													Contact Us
												</a>
											</li>
										</ul>
									</nav>
								</div>
								<button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main nav">
									<i class="fas fa-bars"></i>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>

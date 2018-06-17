<?php
/* The loop starts here. */
global $listingpro_options;
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		setPostViews(get_the_ID());
		$claimed_section = listing_get_metabox('claimed_section');
		$tagline_text = listing_get_metabox('tagline_text');
		$listingAuthorId = get_post_field( 'post_author', get_the_ID() );
		$currentUserId = get_current_user_id();
		$plan_id = listing_get_metabox_by_ID('Plan_id',get_the_ID());
		if(!empty($plan_id)){
			$plan_id = $plan_id;
		}else{
			$plan_id = 'none';
		}

		$contact_show = get_post_meta( $plan_id, 'contact_show', true );
		$map_show = get_post_meta( $plan_id, 'map_show', true );
		$video_show = get_post_meta( $plan_id, 'video_show', true );
		$gallery_show = get_post_meta( $plan_id, 'gallery_show', true );
		$tagline_show = get_post_meta( $plan_id, 'listingproc_tagline', true );
		$location_show = get_post_meta( $plan_id, 'listingproc_location', true );
		$website_show = get_post_meta( $plan_id, 'listingproc_website', true );
		$social_show = get_post_meta( $plan_id, 'listingproc_social', true );
		$faqs_show = get_post_meta( $plan_id, 'listingproc_faq', true );
		$price_show = get_post_meta( $plan_id, 'listingproc_price', true );
		$tags_show = get_post_meta( $plan_id, 'listingproc_tag_key', true );
		$hours_show = get_post_meta( $plan_id, 'listingproc_bhours', true );

		if($plan_id=="none"){
			$contact_show = 'true';
			$map_show = 'true';
			$video_show = 'true';
			$gallery_show = 'true';
			$tagline_show = 'true';
			$location_show = 'true';
			$website_show = 'true';
			$social_show = 'true';
			$faqs_show = 'true';
			$price_show = 'true';
			$tags_show = 'true';
			$hours_show = 'true';
		}

		$claim = '';
		if($claimed_section == 'claimed') {
			$claim = '<span class="claimed"><i class="fa fa-check"></i> '. esc_html__('Claimed', 'listingpro').'</span>';

		}elseif($claimed_section == 'not_claimed') {
			$claim = '';

		}
		global $post;

		$resurva_url = get_post_meta($post->ID, 'resurva_url', true);
		$menuOption = false;
		$menuTitle = '';
		$menuImg = '';
		$menuMeta = get_post_meta($post->ID, 'menu_listing', true);
		if(!empty($menuMeta)){
			$menuTitle = $menuMeta['menu-title'];
			$menuImg = $menuMeta['menu-img'];
			$menuOption = true;
		}

		$timekit = false;
		$timekit_booking = get_post_meta($post->ID, 'timekit_bookings', true);

		if(!empty($timekit_booking)){
			$timekit = true;
		}



		/* get user meta */
		$user_id=$post->post_author;
		$user_facebook = '';
		$user_linkedin = '';
		$user_clinkedin = '';
		$user_facebook = '';
		$user_instagram = '';
		$user_twitter = '';
		$user_pinterest = '';
		$user_cpinterest = '';

		$user_facebook = get_the_author_meta('facebook', $user_id);
		$user_google = get_the_author_meta('google', $user_id);
		$user_linkedin = get_the_author_meta('linkedin', $user_id);
		$user_instagram = get_the_author_meta('instagram', $user_id);
		$user_twitter = get_the_author_meta('twitter', $user_id);
		$user_pinterest = get_the_author_meta('pinterest', $user_id);

		$gAddress = listing_get_metabox('gAddress');
		lp_get_lat_long_from_address($gAddress, get_the_ID());
		/* get user meta */
		$lp_detail_page_additional_detail_position = $listingpro_options['lp_detail_page_additional_styles'];

		$showReport = true;
		if( isset($listingpro_options['lp_detail_page_report_button']) ){
			if( $listingpro_options['lp_detail_page_report_button']=='off' ){
				$showReport = false;
			}
		}

		?>
		<!--==================================Section Open=================================-->
		<section class="aliceblue listing-second-view">


			<div class="post-meta-info">
				<div class="container">
					<div class="top-row-detail">
						<div class="col-md-8 col-sm-8 col-xs-12 better-bread" id="better-breadcrumbs">
							<?php  if (function_exists('listingpro_breadcrumbs')) listingpro_breadcrumbs();  ?>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="post-meta-right-box text-right clearfix">
								<ul class="post-stat">
									<?php
                                        $favrt  =   listingpro_is_favourite_new(get_the_ID());
                                     ?>
									<li id="fav-container">
										<a class="email-address <?php if($favrt == 'yes'){echo 'remove-fav';}else{echo 'add-to-fav';} ?>" data-post-type="detail" href="" data-post-id="<?php echo get_the_ID(); ?>" data-success-text="<?php echo esc_html__('Saved', 'listingpro') ?>">
											<i class="fa <?php echo listingpro_is_favourite(get_the_ID(),$onlyicon=true); ?>"></i>
											<span class="email-icon">
												<?php echo listingpro_is_favourite(get_the_ID(),$onlyicon=false); ?>
											</span>

										</a>
									</li>
									<li class="reviews sbutton">
										<?php listingpro_sharing(); ?>
									</li>

								</ul>

							</div>
						</div>


					</div>
					<div class="row">
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="post-meta-left-box">


								<!-- insert feature image -->
								<div class="item-detail-image">
									<div class="show-img">
										<?php
											if ( has_post_thumbnail()) {
												$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID()), 'listingpro-blog-grid2' );
													if(!empty($image[0])){
														echo "<a href='".get_the_permalink()."' >
																<img src='" . $image[0] . "' />
															</a>";
													}else {
														echo '
														<a href="'.get_the_permalink().'" >
															<img src="'.esc_html__('https://placeholdit.imgix.net/~text?txtsize=33&w=540&h=340', 'listingpro').'" alt="">
														</a>';
													}
											}elseif(!empty($deafaultFeatImg)){
												echo "<a href='".get_the_permalink()."' >
													<img src='" . $deafaultFeatImg . "' />
												</a>";
											}else {
												echo '
												<a href="'.get_the_permalink().'" >
													<img src="'.esc_html__('https://placeholdit.imgix.net/~text?txtsize=33&w=540&h=340', 'listingpro').'" alt="">
												</a>';
											}
										?>
									</div>
									<div class="hide-img listingpro-list-thumb">
										<?php
											if ( has_post_thumbnail()) {
												$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID()), 'listingpro-blog-grid' );
													if(!empty($image[0])){
														echo "<a href='".get_the_permalink()."' >
																<img src='" . $image[0] . "' />
															</a>";
													}else {
														echo '
														<a href="'.get_the_permalink().'" >
															<img src="'.esc_html__('https://placeholdit.imgix.net/~text?txtsize=33&w=540&h=340', 'listingpro').'" alt="">
														</a>';
													}
											}elseif(!empty($deafaultFeatImg)){
												echo "<a href='".get_the_permalink()."' >
													<img src='" . $deafaultFeatImg . "' />
												</a>";
											}else {
												echo '
												<a href="'.get_the_permalink().'" >
													<img src="'.esc_html__('https://placeholdit.imgix.net/~text?txtsize=33&w=540&h=340', 'listingpro').'" alt="">
												</a>';
											}
										?>
									</div>
							   	</div>
								<!-- end of feature image -->


							</div>
						</div>
						<div class="col-md-8 col-sm-8 col-xs-12">
							<h1><?php the_title(); ?> <?php echo $claim; ?></h1>
							<?php if(!empty($tagline_text)) {
										if($tagline_show=="true"){?>
										<p><?php echo $tagline_text; ?></p>
								<?php } ?>
							<?php } ?>

							<?php if(!empty($website)) {
										if($website_show=="true"){?>
										<p><?php echo $website; ?></p>
								<?php } ?>
							<?php } ?>

							<?php
								$pagelayoutOption = $listingpro_options['lp-detail-page-layout-content']['general'];
								if ($pagelayoutOption):
									foreach ($pagelayoutOption as $key=>$value) {
										switch($key) {

											// case 'lp_video_section': get_template_part( 'templates/single-list/listing-details-style1/content/video' );
											// break;

											case 'lp_features_section': get_template_part( 'templates/single-list/listing-details-style1/content/features' );
											break;

											case 'lp_content_section': get_template_part( 'templates/single-list/listing-details-style1/content/content' );
											break;

										}

									}

								endif;
							?>
						</div>
					</div>
				</div>
			</div>
			<div class="content-white-area">
				<div class="container single-inner-container single_listing" >
					<?php if( isset($listingpro_options['lp-gads-editor']) ){
						$listingGAdsense = $listingpro_options['lp-gads-editor'];
						if( !empty($listingGAdsense) ){ ?>

							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<?php echo $listingGAdsense; ?>
								</div>
							</div>

						<?php }
					} ?>
					<div class="row">
						<div class="col-md-8 col-sm-8 col-xs-12">
						<?php
							$pagelayoutOption = $listingpro_options['lp-detail-page-layout-content']['general'];
							if ($pagelayoutOption):
								foreach ($pagelayoutOption as $key=>$value) {
									switch($key) {

										case 'lp_video_section': get_template_part( 'templates/single-list/listing-details-style1/content/video' );
										break;

										case 'lp_content_section': get_template_part( 'templates/single-list/listing-details-style1/content/content' );
										break;

										case 'lp_features_section': get_template_part( 'templates/single-list/listing-details-style1/content/features' );
										break;

										case 'lp_additional_section': get_template_part( 'templates/single-list/listing-details-style1/content/additional' );
										break;

										case 'lp_faqs_section': get_template_part( 'templates/single-list/listing-details-style1/content/faqs' );
										break;

										case 'lp_reviews_section': get_template_part( 'templates/single-list/listing-details-style1/content/reviews' );
										break;

										case 'lp_reviewform_section': get_template_part( 'templates/single-list/listing-details-style1/content/reviewform' );
										break;

									}

								}

							endif;
						?>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<?php
								$pagesidebrOption = $listingpro_options['lp-detail-page-layout-rsidebar']['sidebar'];
								if ($pagesidebrOption):
									foreach ($pagesidebrOption as $key=>$value) {

										switch($key) {


											case 'lp_additional_section': get_template_part( 'templates/single-list/listing-details-style1/sidebar/additional' );
											break;

											case 'lp_sidebarelemnts_section': get_template_part( 'templates/single-list/listing-details-style1/sidebar/def-sidebar' );
											break;


											case 'lp_quicks_section': get_template_part( 'templates/single-list/listing-details-style1/sidebar/quicks' );
											break;

										}
									}
								endif;
							?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--==================================Section Close=================================-->
		<?php
		global $post;
		echo listingpro_post_confirmation($post);
	} // end while
}

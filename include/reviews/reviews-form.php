<?php
if(!function_exists('listingpro_get_reviews_form')){
	function listingpro_get_reviews_form($postid){
		if (class_exists('ListingReviews')) {

			global $listingpro_options;
			$lp_Reviews_OPT = $listingpro_options['lp_review_submit_options'];
			$gSiteKey = '';
			$gSiteKey = $listingpro_options['lp_recaptcha_site_key'];
			$enableCaptcha = lp_check_receptcha('lp_recaptcha_reviews');
			$privacy_policy = $listingpro_options['payment_terms_condition'];
			$privacy_review = $listingpro_options['listingpro_privacy_review'];
			$enableUsernameField = false;
			if( isset($listingpro_options['lp_register_username']) ){
				if($listingpro_options['lp_register_username']==true){
					$enableUsernameField = true;
				}
			}

			if( is_user_logged_in() ){

				?>

					<div class="review-form" id="review-section">
						<h3 id="reply-title" class="comment-reply-title"><i class="fa fa-star-o"></i> <?php
						esc_html_e('Add your feedback','listingpro');
						?> <i class="fa fa-caret-down"></i></h3>
						<form id = "rewies_form" name = "rewies_form" action = "" method = "post" enctype="multipart/form-data">

							<!-- Remove rating option -->
							<!-- <div class = "col-md-6 padding-left-0">
								<div class="form-group margin-bottom-40">
									<p class="padding-bottom-15"><?php
									// esc_html_e('Your Rating for this listing','listingpro');
									?></p>
									<div class="sfdfdf list-style-none form-review-stars">
										<input type="hidden" id="review-rating" name="rating" class="rating-tooltip" data-filled="fa fa-star fa-2x" data-empty="fa fa-star-o fa-2x" />
										<div class="review-emoticons">
											<div class="review angry"><?php
											// echo listingpro_icons('angry');
											?></div>
											<div class="review cry"><?php
											// echo listingpro_icons('crying');
											?></div>
											<div class="review sleeping"><?php
											// echo listingpro_icons('sleeping');
											?></div>
											<div class="review smily"><?php
											// echo listingpro_icons('smily');
											?></div>
											<div class="review cool"><?php
											// echo listingpro_icons('cool');
											?></div>
										</div>
									</div>
								</div>
							</div> -->

							<div class = "col-md-6 pull-right padding-right-0">
								<div class="form-group submit-images">
									<label for = "post_gallery submit-images"><?php esc_html_e('Select Image','listingpro'); ?></label>
									<a href="#" class="browse-imgs"><?php esc_html_e('Browse','listingpro'); ?></a>
									<input type = "file" id = "filer_input2" name = "post_gallery[]" multiple="multiple"/>
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="form-group">
								<label for = "post_title"><?php esc_html_e('Title','listingpro'); ?></label>
								<input placeholder="<?php esc_html_e('Helper text to guide users in what to include here','listingpro'); ?>" type = "text" id = "post_title" class="form-control" name = "post_title" />
							</div>
							<div class="form-group">
								<label for = "post_description"><?php esc_html_e('Review','listingpro'); ?></label>
								<textarea placeholder="<?php esc_html_e('Helper text to guide users in what to include here','listingpro'); ?>" id = "post_description" class="form-control" rows="8" name = "post_description" ></textarea>
								<p><?php esc_html_e('Helper text to remind users to keep this fairly brief','listingpro'); ?></p>
							</div>
							<div class="form-group">
								<?php
									if($enableCaptcha==true){
										if ( class_exists( 'cridio_Recaptcha' ) ){
											if ( cridio_Recaptcha_Logic::is_recaptcha_enabled() ) {
											echo  '<div style="transform:scale(0.88);-webkit-transform:scale(0.88);transform-origin:0 0;-webkit-transform-origin:0 0;" id="recaptcha-'.get_the_ID().'" class="g-recaptcha" data-sitekey="'.$gSiteKey.'"></div>';
											}
										}
									}
								?>
							</div>
							<?php
								if(!empty($privacy_policy) && $privacy_review=="yes"){
							?>
									<div class="form-group lp_privacy_policy_Wrap">
										<input class="lpprivacycheckboxopt" id="reviewpolicycheck" type="checkbox" name="reviewpolicycheck" value="true">
												<label for="reviewpolicycheck"><a target="_blank" href="<?php echo get_the_permalink($privacy_policy); ?>" class="help" target="_blank"><?php echo esc_html__('I Agree', 'listingpro'); ?></a></label>
											<div class="help-text">
												<a class="help" target="_blank"><i class="fa fa-question"></i></a>
												<div class="help-tooltip">
													<p><?php echo esc_html__('You agree & accept our Terms & Conditions for posting this review?.', 'listingpro'); ?></p>
												</div>
											</div>
									</div>
									<p class="form-submit post-reletive">
										<input name="submit_review" type="submit" id="submit" class="lp-review-btn btn-second-hover" value="<?php esc_html_e('Submit Review','listingpro'); ?>" disabled>
										<input type="hidden" name="comment_post_ID" value="<?php echo $postid; ?>" id="comment_post_ID">
										<input type="hidden" name="errormessage" value="<?php esc_html_e('Please fill Email, Title, Description and Rating', 'listingpro'); ?>">
										<span class="review_status"></span>
										<img class="loadinerSearch" width="100px" src="<?php echo get_template_directory_uri().'/assets/images/ajax-load.gif' ?>">
									</p>
							<?php
								}else{
							?>
								<p class="form-submit post-reletive">
									<input name="submit_review" type="submit" id="submit" class="lp-review-btn btn-second-hover" value="<?php esc_html_e('Submit Review','listingpro'); ?>">
									<input type="hidden" name="comment_post_ID" value="<?php echo $postid; ?>" id="comment_post_ID">
									<input type="hidden" name="errormessage" value="<?php esc_html_e('Please fill Email, Title, Description and Rating', 'listingpro'); ?>">
									<span class="review_status"></span>
									<img class="loadinerSearch" width="100px" src="<?php echo get_template_directory_uri().'/assets/images/ajax-load.gif' ?>">
								</p>
							<?php
								}
							?>


						</form>
					</div>
				<?php
			}
			else  { ?>
				<div class="review-form">
					<h3 id="reply-title" class="comment-reply-title"><i class="fa fa-star-o"></i><?php esc_html_e(' Add your feedback ','listingpro'); ?><i class="fa fa-caret-down"></i></h3>
					<?php
						if($lp_Reviews_OPT=="instant_sign_in"){
					?>
						<form id = "rewies_form" name = "rewies_form" action = "" method = "post" enctype="multipart/form-data">
					<?php
						}
						else{
					?>
						<form id = "rewies_formm" name = "rewies_form" action = "#" method = "post" enctype="multipart/form-data">

					<?php } ?>

					<!-- Remove rating option -->
					<!-- <div class = "col-md-6 padding-left-0">
						<div class="form-group margin-bottom-40">
							<p class="padding-bottom-15"><?php
							// esc_html_e('Your Rating for this listing','listingpro');
							?></p>
							<div class="sfdfdf list-style-none form-review-stars">
								<input type="hidden" id="review-rating" name="rating" class="rating-tooltip" data-filled="fa fa-star fa-2x" data-empty="fa fa-star-o fa-2x" />
								<div class="review-emoticons">
									<div class="review angry"><?php
									// echo listingpro_icons('angry');
									?></div>
									<div class="review cry"><?php
									// echo listingpro_icons('crying');
									?></div>
									<div class="review sleeping"><?php
									// echo listingpro_icons('sleeping');
									?></div>
									<div class="review smily"><?php
									// echo listingpro_icons('smily');
									?></div>
									<div class="review cool"><?php
									// echo listingpro_icons('cool');
									?></div>
								</div>
							</div>
						</div>
					</div> -->
						<div class = "col-md-6 pull-right padding-right-0">
							<div class="form-group submit-images">
								<label for = "post_gallery submit-images"><?php esc_html_e('Select Image','listingpro'); ?></label>
								<a href="#" class="browse-imgs"><?php esc_html_e('Browse','listingpro'); ?></a>
								<input type = "file" id = "filer_input2" name = "post_gallery[]" multiple="multiple"/>
							</div>
						</div>
						<div class="clearfix"></div>

						<?php if($enableUsernameField==true){ ?>
							<div class="form-group">
								<label for = "u_mail"><?php esc_html_e('User Name','listingpro'); ?></label>
								<input type = "text" placeholder="<?php esc_html_e('john','listingpro'); ?>" id = "lp_custom_username" class="form-control" name = "lp_custom_username" />
							</div>

						<?php } ?>

						<?php
							if($lp_Reviews_OPT=="instant_sign_in"){
						?>
							<div class="form-group">
								<label for = "u_mail"><?php esc_html_e('Email','listingpro'); ?></label>
								<input type = "email" placeholder="<?php esc_html_e('you@website.com','listingpro'); ?>" id = "u_mail" class="form-control" name = "u_mail" />
							</div>
							<?php } ?>

						<div class="form-group">
							<label for = "post_title"><?php esc_html_e('Title','listingpro'); ?></label>
							<input type = "text" placeholder="<?php esc_html_e('Helper text to guide users in what to include here','listingpro'); ?>" id = "post_title" class="form-control" name = "post_title" />
						</div>
						<div class="form-group">
							<label for = "post_description"><?php esc_html_e('Review','listingpro'); ?></label>
							<textarea placeholder="<?php esc_html_e('Helper text to guide users in what to include here','listingpro'); ?>" id = "post_description" class="form-control" rows="8" name = "post_description" ></textarea>
							<p><?php esc_html_e('Helper text to remind users to keep this fairly brief','listingpro'); ?></p>
						</div>
						<div class="form-group">
								<?php
									if($lp_Reviews_OPT=="instant_sign_in"){
										if($enableCaptcha==true){
											if ( class_exists( 'cridio_Recaptcha' ) ){
												if ( cridio_Recaptcha_Logic::is_recaptcha_enabled() ) {
												echo  '<div style="transform:scale(0.88);-webkit-transform:scale(0.88);transform-origin:0 0;-webkit-transform-origin:0 0;" id="recaptcha-'.get_the_ID().'" class="g-recaptcha" data-sitekey="'.$gSiteKey.'"></div>';
												}
											}
										}
									}
								?>
						</div>
						<?php

							if(!empty($privacy_policy) && $privacy_review=="yes"){
						?>
								<div class="form-group lp_privacy_policy_Wrap">
									<input class="lpprivacycheckboxopt" id="reviewpolicycheck" type="checkbox" name="reviewpolicycheck" value="true">
												<label for="reviewpolicycheck"><a target="_blank" href="<?php echo get_the_permalink($privacy_policy); ?>" class="help" target="_blank"><?php echo esc_html__('I Agree', 'listingpro'); ?></a></label>
												<div class="help-text">
													<a class="help" target="_blank"><i class="fa fa-question"></i></a>
													<div class="help-tooltip">
														<p><?php echo esc_html__('You agree & accept our Terms & Conditions for posting this review?.', 'listingpro'); ?></p>
													</div>
												</div>
								</div>


								<p class="form-submit">
									<?php
										if($lp_Reviews_OPT=="sign_in"){
									?>
										<input name="submit_review" type="submit" id="submit" class="lp-review-btn btn-second-hover md-trigger" data-modal="modal-3" value="<?php echo esc_html__('Submit Review ', 'listingpro');?>" disabled>
									<?php
										}elseif($lp_Reviews_OPT=="instant_sign_in"){
									?>
										<input name="submit_review" type="submit" id="submit" class="lp-review-btn btn-second-hover" value="<?php echo esc_html__('Signup & Submit Review ', 'listingpro');?>" disabled>
									<?php } ?>
									<span class="review_status"></span>
									<img class="loadinerSearch" width="100px" src="<?php echo get_template_directory_uri().'/assets/images/ajax-load.gif' ?>">
								</p>
						<?php
							}else{
						?>
								<p class="form-submit">
									<?php
										if($lp_Reviews_OPT=="sign_in"){
									?>
										<input name="submit_review" type="submit" id="submit" class="lp-review-btn btn-second-hover md-trigger" data-modal="modal-3" value="<?php echo esc_html__('Submit Review ', 'listingpro');?>">
									<?php
										}elseif($lp_Reviews_OPT=="instant_sign_in"){
									?>
										<input name="submit_review" type="submit" id="submit" class="lp-review-btn btn-second-hover" value="<?php echo esc_html__('Signup & Submit Review ', 'listingpro');?>">
									<?php } ?>

									<span class="review_status"></span>
									<img class="loadinerSearch" width="100px" src="<?php echo get_template_directory_uri().'/assets/images/ajax-load.gif' ?>">
								</p>
					<?php
							}
					?>

						<input type="hidden" name="comment_post_ID" value="<?php echo $postid; ?>" id="comment_post_ID">


					</form>
				</div>
				<?php
			}
		}
	}
}
?>

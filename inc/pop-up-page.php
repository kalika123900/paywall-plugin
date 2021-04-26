<?php $baseconfig = get_option('tn_pwl_configuration');
$pop_totalArt = 0;
$pop_days = 1;
$pop_emailArt = 0;
$email_popup_offermsg = get_option('email_popup_offermsg');
$subs_end_popup_msg = get_option('subs_end_popup_msg');
$subs_end_popup_offermsg = get_option('subs_end_popup_offermsg');
$paywall_login_link = get_option('paywall_login_link');
if($paywall_login_link=='')
{
 $paywall_login_link = 'javascript:void(0)';
}
$email_popup_offerlink = get_option('email_popup_offerlink');
if($email_popup_offerlink=='')
{
 $email_popup_offerlink = 'javascript:void(0)';
}
$subs_end_popup_offerlink = get_option('subs_end_popup_offerlink');
if($subs_end_popup_offerlink=='')
{
 $subs_end_popup_offerlink = 'javascript:void(0)';
}
$thanks_popup_msghead = get_option('thanks_popup_msghead');
$thanks_popup_msgtext = get_option('thanks_popup_msgtext');

if(isset($baseconfig['article']))
{
$pop_totalArt = $baseconfig['article']; 
}

if(isset($baseconfig['day']))
{
 $pop_day = $baseconfig['day'];
if($pop_day > 1)
	    {
		$pop_day = $pop_day ." days";
	    }
	    else
	    {
		$pop_day = $pop_day ." day";
	    }
}
if(isset($baseconfig['email_article']))
{
 $pop_emailArt = $baseconfig['email_article'];
}
?><div class='step two modal'><h3 class='modal__title'>You've read <span><?php echo $pop_totalArt; ?> of <?php echo $pop_totalArt; ?> free articles</span> FOR <?php echo $pop_day; ?>.</h3><div class='modal__content'><div class='content__container'><div class='content__signup'><h4>Want <?php echo $pop_emailArt; ?> more free articles?</h4><p>Sign up for The Nation newsletter.</p><form action='#' onsubmit='return tnPaywallFormSubmit();'><input type='email' name='e_mail' class='pcd_email' id='e_mail' placeholder='Your email' /><button type='button' type='button' id='paywallDonateEmail'>Sign Up</button><img class='loaderImg' src='<?php echo get_template_directory_uri(); ?>/images/loader_40x40.GIF' style='display: none' id='loader'></form><p class='msg msg--error errormsg'></p></div><div class='content__subscribe'><h4>Or get unlimited access</h4><p><a class='dark' href='<?php echo $email_popup_offerlink; ?>'><?php echo $email_popup_offermsg;?></a></p><h6>Already a subscriber? <a href='<?php echo $paywall_login_link; ?>'>Log in here.</a></h6></div></div></div><a href='#' class='modal__close'><img src='<?php echo plugin_dir_url( __FILE__ ); ?>/images/modal_close.png' alt='Close Modal' /></a></div><div class='step three modal'><h3 class='modal__title'><?php echo $thanks_popup_msghead;?></h3><p class='center'><?php echo $thanks_popup_msgtext; ?></p><a href='#' class='button btsite centered'>Back to the Site</a><a href='#' class='modal__close'><img src='<?php echo plugin_dir_url(__FILE__); ?>/images/modal_close.png' alt='Close Modal' /></a></div><div class='step four modal'><h3 class='modal__title'><?php echo $subs_end_popup_msg; ?></h3><div class='modal__content'><div class='content__container'><div class='content__signup'><img class='signup__img' src='<?php echo plugin_dir_url(__FILE__); ?>/images/paywall-devices.png' alt='' /><h6 class='prompt'>Already a subscriber? <a href='<?php echo $paywall_login_link; ?>'>Log in here.</a></h6></div><div class='content__subscribe'><h4>Get unlimited access</h4><p><?php echo $subs_end_popup_offermsg; ?></p><a href='<?php echo $subs_end_popup_offerlink; ?>' class='button'>Subscribe</a></div></div></div><a href='#' class='modal__close'><img src='<?php echo plugin_dir_url(__FILE__); ?>/images/modal_close.png' alt='Close Modal' /></a></div>




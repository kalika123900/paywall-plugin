<?php
header('Content-Type: text/javascript');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

require_once("../../../../wp-load.php");
require_once("../tn-paywall.php");

       if(is_user_logged_in())
       die();
	
       $id = '';
       $display = '';
       if(isset($_REQUEST['paywallid'])) 
       $id = base64_decode($_REQUEST['paywallid']);
       else
       die();
       
       $contentID = $id;
       if(isset($_REQUEST['display']))
       {
        $display = base64_decode($_REQUEST['display']);
       } 
	
       $paywall_status = get_option('paywall_status');
	
       if($paywall_status!='on')
       die();
 
       $timeObj = new tn_paywall_storage();
       $IP = tn_paywall::generateFingerPrint($_SERVER);
       $obj = $timeObj->search_document($IP);
	
	
        
	
	
	
	if($display=='none') 
	die(); 
        
	if($display=='block' && $obj==false)
	{
	     $data['article_counter'] = '0';
	     $data['email'] = '';
	     $data['first_login_time'] = time();
	     $data['updated_login_time'] = '0';
	     $data['last_login'] = '';
	     $data['status'] = '1';
	     $data['read_content_id'] = '';
	     $timeObj->create_document($IP,$data);
	}
	$currentPostType = get_post_type($id);
	$userStatus = tn_paywall::userOnPaywall($IP); // get user status 
	if($userStatus==false)
	return ;
	$isContentFree = 'no'; 
	$isContentFree = tn_paywall::isContentFree($id); // check for free content
	
	/* Renewal of Free Articles*/
	$val = tn_paywall::remainDays($userStatus['currentDays'],$userStatus['max_days'],'count');
	if($val<1)
	{
	    $userStatus['article_counter'] = 0;
	    $userStatus['currentDays'] = time();
	    $obj['article_counter'] = 0;
	    $obj['updated_login_time'] = $userStatus['currentDays'];
	    $obj['status'] = 1;
	    $curDoc = $timeObj->current_document($IP);
	    $timeObj->update_document($curDoc,$obj);
	    $obj = $timeObj->search_document($IP);
	}
	/* Renewal of Free Articles Ends here*/
	
	/* Start script for paywall */
	
	echo 'var encodeBase = {_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=encodeBase._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9\+\/\=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=encodeBase._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/\r\n/g,"\n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}';
	echo "\n jQuery.noConflict();";
        echo "\n (function( $ ) {";
	echo "\n pageCounterPaywall = 0; ";
	echo "\n scrollHolderPaywall = {}; ";
	echo "var paywall_d = 'article_counter'; ";
	echo "var paywall_j = 'signature'; ";
	echo "var paywall_f = 'postID'; ";
	echo "var paywall_x = '".$IP."'; ";
	echo "var paywall_email_config = '".$userStatus['is_email_config']."'; ";
	echo "var paywall_email_provider = '".$userStatus['is_email_provider']."'; ";
	echo "var paywall_t = ".$userStatus['max_article']."; ";
	echo "var paywall_c = ".$userStatus['article_counter']."; ";
	echo "var postType = '".$currentPostType."'; ";
	echo "maxdaysPaywall = ".$userStatus['max_days']."; ";
	echo "var isFirstPaid = '".$isContentFree."'; ";
	
	/* Change status in Document */
	if($userStatus['max_article']<=$userStatus['article_counter'])
	{
	   $obj['status'] = '0';
	   $timeObj->update_document($IP,$obj);
	}
	
	
	echo "jQuery('.closebutton').click(function(){ window.location.href = '".site_url()."'; }); ";
	
	/* handles all scroll functionality and counter script*/
	echo 'jQuery(window).bind("scroll", function()
	 {
	  console.log(pageCounterPaywall); 
	 if(scrollHolderPaywall[pageCounterPaywall]!="consumed"){
	  
	    if (( (jQuery("ul.article-share:eq("+pageCounterPaywall+")").length > 0) && (jQuery(this).scrollTop() > jQuery("ul.article-share:eq("+pageCounterPaywall+")").position().top) && postType == "article") || (jQuery(this).scrollTop() > 100))
	 { if((paywall_c >= paywall_t)&& ((isFirstPaid=="no")&&(pageCounterPaywall==0)))
	   {
	     scrollHolderPaywall[pageCounterPaywall]="consumed";';
	   echo '}
	   else if(paywall_c >= paywall_t)
	   {
	   
	 scrollHolderPaywall[pageCounterPaywall]="consumed";
	 var paywall_A = {};
	 paywall_A[paywall_d]= paywall_c;
	 paywall_A[paywall_j]= paywall_x;
	 paywall_A["endAccess"] = "yes";
	 paywall_A.paywallpostID = "'.$contentID.'";
	 if(pageCounterPaywall>0)
	 { 
	   paywall_A.paywallpostID = jQuery(".scrolltrace:last").attr("article-post-id");
	 }
	 var paywall_s = JSON.stringify(paywall_A);
	 var paywall_z85 = encodeBase.encode(paywall_s);
	 jQuery.post( "'. plugins_url( 'requestHandler.php', dirname(__FILE__) ).'",
	 { paywall : paywall_z85} ).done(function( paywall_r ) {
	    if(paywall_r=="stop")
	    {
	    paywall_q = paywall_t+" OF "+ paywall_t;
	    if(paywall_t>1)
	    {
		paywall_q = paywall_q + " Free articles";
	    }
	    else
	    {
		paywall_q = paywall_q + " Free article";
	    }
	     jQuery("#meter").find("#paywall_remain_count").html(paywall_q);
	     Paywall.hide();
	     if(paywall_email_config=="yes" && paywall_email_provider=="no")
	     {
	      Paywall.show(".two");
	     }
	     else
	     {
	      Paywall.show(".four");	
	     }
	    } 
	    });
	 
	    
	   }
	 else
	 {
	 paywall_c++;
	 scrollHolderPaywall[pageCounterPaywall]="consumed";
	 var paywall_A = {};
	 paywall_A[paywall_d]= paywall_c;
	 paywall_A[paywall_j]= paywall_x;
	 paywall_A.paywallpostID = "'.$contentID.'";
	 if(pageCounterPaywall>0)
	 { 
	   paywall_A.paywallpostID = jQuery(".scrolltrace:last").attr("article-post-id");
	 }
	 var paywall_s = JSON.stringify(paywall_A);
	 var paywall_z85 = encodeBase.encode(paywall_s);
	 jQuery.post( "'. plugins_url( 'requestHandler.php',  dirname(__FILE__) ).'",
	 { paywall : paywall_z85} ).done(function( paywall_r ) { if(paywall_r=="success"){
	   //    paywall_q = paywall_t-paywall_c;
	   //    if(paywall_q < 0)
	   //    {
	   //	paywall_q = 0;
	   //    }
	    if(paywall_c > paywall_t) { paywall_q = paywall_t+" OF "+ paywall_t;} else {paywall_q = parseInt(paywall_c-1)+" OF "+ paywall_t;}
	    if(paywall_t>1)
	    {
		paywall_q = paywall_q + " Free articles";
	    }
	    else
	    {
		paywall_q = paywall_q + " Free article";
	    }
	    console.log(paywall_q);
	    jQuery("#meter").find(".meerkat__title").find("span").html(paywall_q);
	 } else if(paywall_r=="no") { paywall_c = paywall_c-1; console.log(paywall_c); }
	    meterShow = jQuery("#meter").attr("data-visible");
	    isShow = parseInt(paywall_c)%(parseInt(meterShow)+1);
	    
	    if(meterShow=="-1" || (isShow==0) && (paywall_c !=0) && (paywall_c <= paywall_t) )
	    {
	     Paywall.show(".one");
	    }
	    else
	    {
	     Paywall.hide();	
	    }
	 });
	  }
	 }
	}
	});';
	echo "})( jQuery );";
	
	/* Paywall Blocking box */
	$data ="<div id='paywall'>";
	ob_start();
	include_once("pop-up-page.php");
	$data .= ob_get_clean();
	$data = trim($data);
	$data .= "</div>";
	/* Paywall Blocking box */
	
	echo 'jQuery(document).ready(function(){
	jQuery("'.$data.'").insertBefore("footer:eq(0)");
	});';
	
	/* Handle meter script*/
	tn_paywall::show_counter($IP);
	return 0;
       ?>      
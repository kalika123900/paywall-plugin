<?php 
/* The Nation Metered Paywall */
$paywallStatus = get_option('paywall_status');
$baseconfig = get_option('tn_pwl_configuration');
$subjectconfig = get_option('tn_pwl_free_subject');
$infiniteScroll = get_option('tn_pwl_scroll_count');
$keywordconfig = get_option('tn_pwl_free_keyword');				
$taxonomyconfig = get_option('tn_pwl_free_admin_taxonomy');
$typeconfig = get_option('tn_pwl_applied_post_type');
$noti_popup_config = get_option('tn_noti_popup'); 
$sponserAdConfig = get_option('tn_sponser_ad_config');
$uniquearticle = get_option('tn_uniquearticle_check');

?>
<div id="col-container">
 <div class="row">
  <form action="" method="post">
  <div class="col-lg-10">
   <h1 class="page-header">Metered Paywall</h1>
  </div>
  </div>
 <div class="row">
  <div class="col-lg-10">
   <div class="panel panel-default">
    <div class="panel-heading">
       <strong>Paywall Switch On/Off</strong>
     </div>
     <div class="panel-body">
      <div class="row">
        <div class="col-md-4"><strong class="primary-font">Switch  </strong></div>
	<div class="col-md-6">
	<div class="onoffswitch">
	<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" value="on" id="myonoffswitch" <?php if($paywallStatus=='on') echo 'checked'; ?>>
	   <label class="onoffswitch-label" for="myonoffswitch">
	       <span class="onoffswitch-inner"></span>
	       <span class="onoffswitch-switch"></span>
	   </label>
       </div>
      </div>
      </div>
      </div>
   </div>
  </div>
 </div>
 <div class="row">
  <div class="col-lg-10">
   <div class="panel panel-default">
    <div class="panel-heading">
       <strong>Free Access Configuration</strong>
     </div>
     <div class="panel-body">
      <div class="row">
        <div class="col-md-4"><strong class="primary-font">No of Free Article</strong></div>
	<div class="col-md-6"><input type="number" name="number_article" min="1" value="<?php if(is_array($baseconfig)&&isset($baseconfig['article'])) { echo $baseconfig['article']; }?>"></div>
      </div>
      <br/>
       <div class="row">
        <div class="col-md-4"><strong class="primary-font">Time Span for Free Access</strong></div>
	<div class="col-md-6"><input type="number" name="number_day" min="1" value="<?php if(is_array($baseconfig)&&isset($baseconfig['day'])) { echo $baseconfig['day']; }?>">
	<span class="primary-font"><strong>&nbsp;(In Days)</strong></span></div>
      </div>
       
     </div>
   </div>
  </div>
 </div>
 <!-----Free Articles------>
<!-------- E-mail Articles ---------->
<div class="row">
  <div class="col-lg-10">
   <div class="panel panel-default">
    <div class="panel-heading">
       <strong>E-mail Access Configuration</strong>
     </div>
    <?php $disabled = 'disabled'; ?>
     <div class="panel-body">
      <div class="row">
        <div class="col-md-4"><strong class="primary-font">Do you want e-mail Pop-up?</strong></div>
	<div class="col-md-6"><input type="checkbox" id="is_email" name="email_popup" value="yes" <?php if(is_array($baseconfig)&&isset($baseconfig['is_email_popup']) && ($baseconfig['is_email_popup']=='yes')) { echo 'checked="checked"'; $disabled = ''; } ?>></div>
      </div>
      <br/>
      <div class="row email_popup" <?php if(is_array($baseconfig)&&isset($baseconfig['is_email_popup']) && ($baseconfig['is_email_popup']=='yes')) { echo 'style="display:block"'; } else {echo 'style="display:none"'; } ?> >
        <div class="col-md-4"><strong class="primary-font">No of Free Content</strong></div>
	<div class="col-md-6"><input type="number" class="is_email_cont" name="email_number_article" min="1" value="<?php if(is_array($baseconfig)&&isset($baseconfig['email_article'])) { echo $baseconfig['email_article']; } ?>" <?php echo $disabled;  ?>></div>
      </div>
      <br/>
       <div class="row email_popup" <?php if(is_array($baseconfig)&&isset($baseconfig['is_email_popup']) && ($baseconfig['is_email_popup']=='yes')) { echo 'style="display:block"';} else {echo 'style="display:none"'; } ?>>
        <div class="col-md-4"><strong class="primary-font">Time Span for Free Access</strong></div>
	<div class="col-md-6"><input type="number" class="is_email_cont" name="email_number_day" min="1" value="<?php if(is_array($baseconfig)&&isset($baseconfig['email_day'])) { echo $baseconfig['email_day']; } ?>" <?php echo $disabled;  ?>>
	<span class="primary-font"><strong>&nbsp;(In Days)</strong></span></div>
      </div>
     </div>
   </div>
  </div>
  <script>
   jQuery(document).ready(function(){
    jQuery('#is_email').click(function(){
     jQuery('.email_popup').slideToggle('slow');
     jQuery('.is_email_cont').prop('disabled', function(i, v) { return !v; });
     }); 
   })
  </script>
 </div>
<!-------- E-mail Articles ---------->

<div class="row" style="display: none;">
  <div class="col-lg-10">
   <div class="panel panel-default">
    <div class="panel-heading">
       <strong>Free Content Sponsors Pop-up</strong>
     </div>
    <?php $spdisabled = 'disabled'; ?>
     <div class="panel-body">
      <div class="row">
        <div class="col-md-4"><strong class="primary-font">Do You want to show Sponsor Pop-up?</strong></div>
	<div class="col-md-6"><input type="checkbox" id="is_sponser_popup" name="is_sponser_popup" value="yes" <?php if(is_array($sponserAdConfig)&&isset($sponserAdConfig['is_sponser_popup']) && ($sponserAdConfig['is_sponser_popup']=='yes')) { echo 'checked="checked"'; $spdisabled = ''; } ?>></div>
      </div>
      <br/>
      <div class="row sponser_popup" <?php if(is_array($sponserAdConfig)&&isset($sponserAdConfig['is_sponser_popup']) && ($sponserAdConfig['is_sponser_popup']=='yes')) { echo 'style="display:block"'; } else {echo 'style="display:none"'; } ?> >
        <div class="col-md-4"><strong class="primary-font">Pop-up After Reading Content</strong></div>
	<div class="col-md-6"><input type="number" class="sponser_ad_articlecount" name="sponser_ad_articlecount" min="1" value="<?php if(is_array($sponserAdConfig)&&isset($sponserAdConfig['sponser_ad_articlecount'])) { echo $sponserAdConfig['sponser_ad_articlecount']; } ?>" <?php echo $spdisabled; ?>></div>
      </div>
      <br/>
      <div class="row sponser_popup" <?php if(is_array($sponserAdConfig)&&isset($sponserAdConfig['is_sponser_popup']) && ($sponserAdConfig['is_sponser_popup']=='yes')) { echo 'style="display:block"'; } else {echo 'style="display:none"'; } ?> >
        <div class="col-md-4"><strong class="primary-font">Pop-up Content</strong></div>
	<div class="col-md-6"><textarea class="sponser_ad_articlecount" name="sponser_ad_content" <?php echo $spdisabled; ?>><?php if(is_array($sponserAdConfig)&&isset($sponserAdConfig['sponser_ad_content'])) { echo $sponserAdConfig['sponser_ad_content']; } ?></textarea></div>
      </div>
      </div>
   </div>
  </div>
  <script>
   jQuery(document).ready(function(){
    jQuery('#is_sponser_popup').click(function(){
     jQuery('.sponser_popup').slideToggle('slow');
     jQuery('.sponser_ad_articlecount').prop('disabled', function(i, v) { return !v; });
     }); 
   })
  </script>
 </div>
<!-------- E-mail Articles ---------->
<div class="row">
  <div class="col-lg-10">
   <div class="panel panel-default">
    <div class="panel-heading">
       <strong>Remaining Content Notification</strong>
     </div>
     <div class="panel-body">
      <div class="row">
        <div class="col-md-4"><strong class="primary-font">Every-time</strong></div>
	<div class="col-md-6"><input type="checkbox" id="noti_pop_up" name="notification_pop_up" <?php if($noti_popup_config==-1||$noti_popup_config==false||$noti_popup_config==''){echo 'checked="checked"';} ?>></div>
      </div>
      <br/>
       <div class="row" id="noti_pop_up_count" <?php if($noti_popup_config==-1||$noti_popup_config==false||$noti_popup_config==''){echo 'style="display:none;"'; } ?>>
        <div class="col-md-4"><strong class="primary-font">After</strong></div>
	<div class="col-md-6"><input type="number" name="noti_popup_count" min="1" id="noti_pop_up_counter" <?php if($noti_popup_config>0){echo 'value="'.$noti_popup_config.'"';} else { echo 'disabled'; }?>></div>
      </div>
     </div>
   </div>
  </div>
  <script>
   jQuery(document).ready(function(){
    jQuery('#noti_pop_up').click(function(){
     jQuery('#noti_pop_up_count').slideToggle('slow');
     jQuery('#noti_pop_up_counter').prop('disabled', function(i, v) { return !v; });
     }); 
   })
  </script>
 </div>
<!-------------- Applied Post Types ---------------->
<div class="row">
  <div class="col-lg-10">
   <div class="panel panel-default">
     <div class="panel-heading">
       <strong>Applied on Post-Types</strong>
     </div>
     <div class="panel-body">
     <div class="row">
        <div class="col-md-4"><strong class="primary-font">Post Type</strong></div>
	<div class="col-md-8">
	 <select name="paywall_post[]" id="paywall_post" multiple="multiple">
	 <option></option>
	<?php
	 $args = array(
	    'name' => 'property'
	 );
	 
	 $output = 'objects'; // names or objects
	 
	 $post_types = ['article','authors','magazineissue','page'];
	 
	 if(!empty($post_types)):
	 foreach ( $post_types as $post_type ) {
	  if(is_array($typeconfig) && in_array($post_type,$typeconfig))
	  {
	   echo '<option value="'.$post_type.'" selected="selected">' . $post_type . '</option>'; 
	  }
	  else
	  {
           echo '<option value="'.$post_type.'">' . $post_type . '</option>';
          } 
	 }
	 endif;
	 ?> 
	 </select>
	 <script>
	 jQuery(document).ready(function(){
	  jQuery("#paywall_post").select2({ placeholder: "Select Post Type"});
	  });
	</script>
	</div>
     </div>	
     </div> 
   </div>
   </div>
</div>
<!-- Configuration for Infinite Scroll -->
<div class="row" style="display: none;">
  <div class="col-lg-10">
   <div class="panel panel-default">
     <div class="panel-heading">
       <strong>Count on Infinite Scroll</strong>
     </div>
     <div class="panel-body">
     <div class="row">
        <div class="col-md-4"><strong class="primary-font">Counting?</strong></div>
	<div class="col-md-8">
	    <input type="checkbox" value="yes" name="scrollCount" <?php if($infiniteScroll=='yes') echo 'checked="checked"'; ?>>
	</div>
     </div>	
     </div> 
   </div>
   </div>
</div>
<div class="row">
  <div class="col-lg-10">
   <div class="panel panel-default">
     <div class="panel-heading">
       <strong>Miscellenous Configuration</strong>
     </div>
     <div class="panel-body">
     <div class="row">
        <div class="col-md-4"><strong class="primary-font">Only Unique Content Count?</strong></div>
	<div class="col-md-8">
	    <input type="checkbox" value="yes" name="uniquearticles" <?php if($uniquearticle=='yes') echo 'checked="checked"'; ?>>
	</div>
     </div>	
     </div> 
   </div>
   </div>
</div>
<!-------------- E-mail Articles --------------->
  <?php
  
  /*
 Only 1 admin-taxonomy will be available to make content free, as per discussion disable by diaspark
 <div class="row">
  <div class="col-lg-10">
   <div class="panel panel-default">
    <div class="panel-heading">
       <strong>Free Taxonomies</strong>
     </div>
     <div class="panel-body">
     <div class="row">
        <div class="col-md-4"><strong class="primary-font">Subject</strong></div>
	<div class="col-md-8">
	 <select name="subject[]" id="subject" multiple="multiple">
	 <option></option>
	 <?php
	 $terms = get_terms( 'subject' );
	 if(!empty($terms)):
	 foreach ( $terms as $term ) {
	  if(is_array($subjectconfig) && in_array($term->term_id,$subjectconfig))
	  {
	   echo '<option value="'.$term->term_id.'" selected="selected">' . $term->name . '</option>'; 
	  }
	  else
	  {
           echo '<option value="'.$term->term_id.'">' . $term->name . '</option>';
          } 
	 }
	 endif;
	 ?> 
	 </select>
	<script>
	 jQuery(document).ready(function(){
	  jQuery("#subject").select2({ placeholder: "Select Subject"});
	  });
	</script>
	</div>
      </div>
      <br/>
      <div class="row">
        <div class="col-md-4"><strong class="primary-font">Keyword</strong></div>
	<div class="col-md-8">
	 <select id="keyword" name="keyword[]" multiple="multiple">
	 <option></option>
	 <?php
	 $terms = get_terms( 'keyword' );
	 if(!empty($terms)):
	 foreach ( $terms as $term ) {
         if(is_array($keywordconfig) && in_array($term->term_id,$keywordconfig))
	  {
	   echo '<option value="'.$term->term_id.'" selected="selected">' . $term->name . '</option>'; 
	  }
	  else
	  {
           echo '<option value="'.$term->term_id.'">' . $term->name . '</option>';
          } 
         }
	 endif;
	 ?>
	 </select>
	<script>
	 jQuery(document).ready(function(){
	  jQuery("#keyword").select2({ placeholder: "Select Keyword"});
	  });
	</script>
	</div>
      </div>
      <br/>
      <div class="row">
        <div class="col-md-4"><strong class="primary-font">Admin-Taxonomies</strong></div>
	<div class="col-md-8">
	 <select id="admin_taxonomy" name="admin_taxonomy[]" multiple="multiple">
	 <option></option> 
	  <?php
	 $terms = get_terms( 'admin-taxonomy' );
	 if(!empty($terms)):
	 foreach ( $terms as $term ) {
          if(is_array($taxonomyconfig) && in_array($term->term_id,$taxonomyconfig))
	  {
	   echo '<option value="'.$term->term_id.'" selected="selected">' . $term->name . '</option>'; 
	  }
	  else
	  {
           echo '<option value="'.$term->term_id.'">' . $term->name . '</option>';
          } 
         }
	 endif;
	 ?>
	</select>
	<script>
	 jQuery(document).ready(function(){
	  jQuery("#admin_taxonomy").select2({ placeholder: "Select Admin Taxonomy"});
	  });
	</script>
	</div>
      </div>
      </div>
   </div>
  </div>
 </div> 
*/ ?>	
 <div class="row">
   <div class="col col-lg-10">
          <button type="submit" class="btn btn-default" name="save"><i class="glyphicon glyphicon-floppy-save"></i>&nbsp; Save</button>
   </div> 
   </div>
 </form>
</div>

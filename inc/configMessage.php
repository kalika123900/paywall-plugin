<?php
$noti_popup_offermsg = get_option('noti_popup_offermsg');
$noti_popup_offerlink = get_option('noti_popup_offerlink');
$email_popup_offermsg = get_option('email_popup_offermsg');
$email_popup_offerlink = get_option('email_popup_offerlink');
$thanks_popup_msghead = get_option('thanks_popup_msghead');
$thanks_popup_msgtext = get_option('thanks_popup_msgtext');
$subs_end_popup_offermsg = get_option('subs_end_popup_offermsg');
$subs_end_popup_offerlink = get_option('subs_end_popup_offerlink');
$subs_end_popup_msg = get_option('subs_end_popup_msg');
$paywall_login_link = get_option('paywall_login_link');
?>
<div id="col-container">
  <form action="" method="post">
   <div class="row">
   <div class="col-lg-10">
    <h1 class="page-header">Metered Paywall - Message Configuration</h1>
  </div>
  </div>
  <div class="row">
  <div class="col-lg-10">
   <div class="panel panel-default">
    <div class="panel-heading">
       <strong>Login Configuration</strong>
     </div>
     <div class="panel-body">
      <div class="row">
        <div class="col-md-4"><strong class="primary-font">Login Page Link </strong></div>
	<div class="col-md-6"><input type="text" name="paywall_login_link" style="width: 100%" value="<?php echo $paywall_login_link; ?>"/></div>
      </div>
      </div>
   </div>
  </div>
 </div>  
 <div class="row">
  <div class="col-lg-10">
   <div class="panel panel-default">
    <div class="panel-heading">
       <strong>Notification Pop-up</strong>
     </div>
     <div class="panel-body">
      <div class="row">
        <div class="col-md-4"><strong class="primary-font">Offer Message </strong></div>
	<div class="col-md-6"><textarea name="noti_popup_offermsg" style="width: 100%; height: 150px "><?php echo $noti_popup_offermsg; ?></textarea></div>
      </div><br/>
      <div class="row">
        <div class="col-md-4"><strong class="primary-font">Offer Subscription Link </strong></div>
	<div class="col-md-6"><input type="text" name="noti_popup_offerlink" style="width: 100%" value="<?php echo $noti_popup_offerlink; ?>"></div>
      </div>
      </div>
   </div>
  </div>
 </div>
 <div class="row">
  <div class="col-lg-10">
   <div class="panel panel-default">
    <div class="panel-heading">
       <strong>Notification Pop-up</strong>
     </div>
     <div class="panel-body">
      <div class="row">
        <div class="col-md-4"><strong class="primary-font">E-mail Collection Pop-up Message </strong></div>
	<div class="col-md-6"><textarea name="email_popup_offermsg" style="width: 100%; height: 150px"><?php echo $email_popup_offermsg; ?></textarea></div>
      </div><br/>
      <div class="row">
        <div class="col-md-4"><strong class="primary-font">Offer Subscription Link </strong></div>
	<div class="col-md-6"><input type="text" name="email_popup_offerlink" style="width: 100%" value="<?php echo $email_popup_offerlink; ?>"></div>
      </div>
      </div>
   </div>
  </div>
 </div>
 <div class="row">
  <div class="col-lg-10">
   <div class="panel panel-default">
    <div class="panel-heading">
       <strong>Thank You Pop-up</strong>
     </div>
     <div class="panel-body">
      <div class="row">
        <div class="col-md-4"><strong class="primary-font">Message Heading </strong></div>
	<div class="col-md-6"><input type="text" name="thanks_popup_msghead" style="width: 100%;" value="<?php echo $thanks_popup_msghead; ?>"></div>
      </div><br/>
      <div class="row">
        <div class="col-md-4"><strong class="primary-font">Message Text </strong></div>
	<div class="col-md-6"><textarea name="thanks_popup_msgtext" style="width: 100%;  height: 150px" ><?php echo $thanks_popup_msgtext; ?></textarea></div>
      </div>
      </div>
   </div>
  </div>
 </div>
 <div class="row">
  <div class="col-lg-10">
   <div class="panel panel-default">
    <div class="panel-heading">
       <strong>Subscription End Pop-up</strong>
     </div>
     <div class="panel-body">
      <div class="row">
        <div class="col-md-4"><strong class="primary-font">Offer End Message  </strong></div>
	<div class="col-md-6"><input type="text" name="subs_end_popup_msg" style="width: 100%" value="<?php echo $subs_end_popup_msg; ?>"></div>
      </div>
      <div class="row">
        <div class="col-md-4"><strong class="primary-font">Offer Message </strong></div>
	<div class="col-md-6"><textarea name="subs_end_popup_offermsg" style="width: 100%; height: 150px"><?php echo $subs_end_popup_offermsg; ?></textarea></div>
      </div><br/>
      <div class="row">
        <div class="col-md-4"><strong class="primary-font">Offer Subscription Link </strong></div>
	<div class="col-md-6"><input type="text" name="subs_end_popup_offerlink" style="width: 100%" value="<?php echo $subs_end_popup_offerlink; ?>"></div>
      </div>
      </div>
   </div>
  </div>
 </div>
 <div class="row">
   <div class="col col-lg-10">
          <button type="submit" class="btn btn-default" name="save"><i class="glyphicon glyphicon-floppy-save"></i>&nbsp; Save</button>
   </div> 
   </div>
 </form>
</div>

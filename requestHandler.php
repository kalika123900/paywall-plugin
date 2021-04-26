<?php
require_once("../../../wp-load.php");
require_once(dirname(__FILE__) . '/tn-paywall-storage.php');
$storeObj = new tn_paywall_storage();
if(isset($_REQUEST['paywall']))
{
  $data = json_decode(base64_decode($_REQUEST['paywall']),'true');
  
  $contentID = $data['paywallpostID'];
  
  $admin_tax = get_option('tn_pwl_free_admin_taxonomy');
  $keyword = get_option('tn_pwl_free_keyword');
  $subject = get_option('tn_pwl_free_subject');
 
  $sub_art = wp_get_post_terms( $contentID, 'subject', array("fields" => "ids"));
  $key_art = wp_get_post_terms( $contentID, 'keyword', array("fields" => "ids"));
  $adm_tax = wp_get_post_terms( $contentID, 'admin-taxonomy', array("fields" => "ids"));
	    
	     /* Logic to fetch free articles*/
    $free_term = term_exists( 'no-paywall', 'admin-taxonomy' );
    
    if(is_array($free_term) && is_array($admin_tax))
    {
      array_push($admin_tax,$free_term['term_id']);
    }
    else
    {
        $admin_tax = array($free_term['term_id']);
    }
    
    /* Logic to fetch free articles*/
    
    $flag = 'yes'; // Free Article Flag, Says By Default Article is Premium
    
    //Condition Checks the Article Whether Premium or not
    
    if(is_array($admin_tax)&&is_array($adm_tax)):
    $check1 = false;
    $check1 = array_intersect($admin_tax,$adm_tax);
    if(is_array($check1) && !empty($check1))
    {
        $flag = 'no';
    }
    endif;
    
    if(is_array($keyword)&&is_array($key_art)):
    $check2 = false;
    $check2 = array_intersect($keyword,$key_art);
    if(is_array($check2) && !empty($check2))
    {
        $flag = 'no';
    }
    endif;
    
    if(is_array($subject)&&is_array($sub_art)):
    $check3 = false;
    $check3 = array_intersect($subject,$sub_art);
    if(is_array($check3) && !empty($check3))
    {
        $flag = 'no';
    }
    
    endif;
    
    if($flag == 'no')
    {
     echo 'no';
        die();	
    }
  $cur_Doc = $storeObj->current_document($data['signature']);
  if($cur_Doc==false)
  {
    echo 'block';
  }
  else
  { 
    $updateData = $storeObj->get_content($cur_Doc);
    $readContent = $updateData['read_content_id'];
    if($readContent=='')
    {
       $readContent[]= $data['paywallpostID']; 
    }
    else
    {
        $readContent = maybe_unserialize($readContent);
        $isunique = get_option('tn_uniquearticle_check');
        if($isunique=='yes')
        {
            if(in_array($data['paywallpostID'],$readContent))
            {
                echo 'no';
                die();
            }
        }
        if(isset($data['endAccess']) && $data['endAccess']=="yes")
        {
            echo 'stop';
            die();
        }
        array_push($readContent,$data['paywallpostID']);
        $readContent = maybe_serialize($readContent);
    }
    $updateData['article_counter'] = $data['article_counter'];
    $updateData['last_login'] = time();
    $updateData['read_content_id'] = $readContent;
    $updateData = $storeObj->update_document($cur_Doc,$updateData);
    echo 'success';
  }
}
?>

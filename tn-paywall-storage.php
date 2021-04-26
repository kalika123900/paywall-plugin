<?php 
/* The Nation Metered Paywall */
class tn_paywall_storage
{
 public $plugindirurl;
 
 public function __construct()
 {
    $upload_dir = wp_upload_dir();
    if(!is_array($upload_dir))
    {
     return false;       
    }
    $this->plugindirurl = $upload_dir['basedir']."/paywall";
     
    if(!file_exists($this->plugindirurl))
    {
       mkdir($this->plugindirurl);
    }
    $emailCollection = $this->plugindirurl."/nonsubscriber.json";
    if(!file_exists($emailCollection))
    {   $collection = [];
        $myfile = fopen($emailCollection, "w") or die("Unable to open file!");
        fwrite($myfile, json_encode($collection));
        fclose($myfile);
    }
 }
 public function __destruct()
 {
 
 }
 public function nonsubscriberEmailCollection()
 {  $array = [];
    $emailCollection = $this->plugindirurl."/nonsubscriber.json"; 
    $collection = file_get_contents($emailCollection);
  
    if($collection!='' && (is_object(json_decode($collection))|| is_array(json_decode($collection))))
    {
        $array = json_decode($collection,true);
    }
   
    return $array;
 }
 public function nonsubscriberemailpush($email)
 {
    $array = [];
    $emailCollection = $this->plugindirurl."/nonsubscriber.json"; 
    $array = $this->nonsubscriberEmailCollection();
    array_push($array,$email);
    $response = file_put_contents($emailCollection,json_encode($array));
    return $response;
 }
 public function create_document($fingerprint, $data)
 {  
    $current_month = $this->plugindirurl."/".date('Y')."_".date('n');
    if(!file_exists($current_month))
    {
      mkdir($current_month);
    }
    $thisFile = $current_month."/".$fingerprint.".txt";
    $document = fopen($thisFile, "w");
    $data = maybe_serialize($data);
    if(file_exists($thisFile))
    {
     fwrite($document, $data);   
    }
    return false;
 }
 
 public function search_document($fingerprint)
 {
    
    $year = date('Y');
    $month = date('n');
    $current_month_path = $this->plugindirurl."/".$year."_".$month;
    $prev_month_path = '';
    if($month==1)
    {
    $prev_month_path = $this->plugindirurl."/".(intval($year)-1)."_12";    
    }
    else
    {
    $prev_month_path = $this->plugindirurl."/".$year."_".(intval($month)-1);    
    }
    $doc_search_1 = $current_month_path."/".$fingerprint.".txt";
    $doc_search_2 = $prev_month_path."/".$fingerprint.".txt";
   
    if(file_exists($doc_search_1))
    {
     return $this->get_content($doc_search_1);
    }
    else if(file_exists($doc_search_2))
    {
     return $this->get_content($doc_search_2);
    }
    return false;
 }
 public function get_content($document)
 {  if(!file_exists($document))
        return false;
    else
    {
        $data = file_get_contents($document);
        $data = maybe_unserialize($data);
        return $data;
    }
 }
 public function current_document($fingerprint)
 {
    $year = date('Y');
    $month = date('n');
    $current_month_path = $this->plugindirurl."/".$year."_".$month;
    $prev_month_path = '';
    if($month==1)
    {
    $prev_month_path = $this->plugindirurl."/".(intval($year)-1)."_12";    
    }
    else
    {
    $prev_month_path = $this->plugindirurl."/".$year."_".(intval($month)-1);    
    }
    $doc_search_1 = $current_month_path."/".$fingerprint.".txt";
    $doc_search_2 = $prev_month_path."/".$fingerprint.".txt";
   
    if(file_exists($doc_search_1))
    {
     return $doc_search_1;
    }
    else if(file_exists($doc_search_2))
    {
     return $doc_search_2;
    }
    return false;
 }
 public function update_document($document,$data)
 {
    $existData = $this->get_content($document);
    if(!is_array($existData))
    return false;
  
    foreach($data as $key=>$value)
    {
        $existData[$key] = $value;
    }
    $existData = maybe_serialize($existData);
    file_put_contents($document,$existData);
    return true;
 }

}
?>
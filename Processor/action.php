<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
require_once './home.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$message = '';
//if(isset($_POST['submit']))
//{ 
//$target_dir = "uploads/";
//$target_file = $target_dir .time()."-". basename($_FILES["feed_data"]["name"]);
//move_uploaded_file($_FILES["feed_data"]["tmp_name"], $target_file);
$file = fopen($argv[2],"r");
//echo '<pre>';
//$datum = array();
$fields = explode(",",str_replace('"','',str_replace(";",",",str_replace(",","|",fgets($file)))) );
//array_push($fields,"Status");
//print_r($fields);
$rowcount = count($fields);
while(! feof($file))
{
        $frow = explode(",", str_replace('"','',str_replace(";",",",str_replace(",","|",fgets($file)))) );
        $datum[] = $frow;
        foreach ($frow as $k =>$val)
        {
            
            if(array_search('Product category',$fields)==$k)
            {
                $datas[$fields[$k]][] = substr(str_replace("|",",",$val),0,255)==''?'test adgroup':substr(str_replace("|",",",$val),0,255); 
            $dataads[substr(str_replace("|",",",$val),0,255)][] = array('img'=>'img','short_head'=>$frow[array_search('Product short-name',$fields)],'long_head'=>$frow[array_search('Product name',$fields)],'desc'=>$frow[array_search('Product description',$fields)],'url'=>$frow[array_search('Link to Product',$fields)],'status'=>$frow[Credentials::$STATUS_FIELD]);            
            }
            else
            {
                $datas[$fields[$k]][] = $val; 
            }
        }
}
fclose($file);
//print_r(array_unique($datum['Product category']));
//print_r($datum);
try{
    $data = new AdwordsMethods();
//        echo '<pre>';
//    print_r(sort($datas['Product category']));
//    print_r($datas);
//        var_dump($datas);
//    print_r($datum);
//    echo count($dataads);
//    print_r($dataads);
//    list down the adgroups
//   print_r($data->get_adgroups(Credentials::$ACCOUNT_ID,$argv[1] ));
//   exit();
   
    $adgroups = $data->get_adgroups(Credentials::$ACCOUNT_ID,$argv[1] );
    $adgroups_name = array();
//    print_r($adgroups);
//    exit();
    if(count($adgroups)>0)
    {
    foreach($adgroups[$argv[1]] as $adg)
    {
//        $adgroups_name[number_format($adg['adgroupid'], 0, '', '')] = $adg['adgroup_name'];
        $adgroups_name[$adg['adgroupid']] = $adg['adgroup_name'];
    }   
    
    }
    $adgroups_created=array_unique(array_diff($datas['Product category'],$adgroups_name));
    
//    print_r($adgroups_created);
//    $prd_ctg = $datas['Product category'];
////    print_r($prd_ctg);
//    print_r(array_unique($prd_ctg));
//    exit();
    
//    $result=array_diff($adgroups_name,array_unique($datas['Product category']));

    $num = 50;
    if(count($adgroups_created)>0)
    {
        $len = count($adgroups_created);
        $part = $num;
        $seg = $num;
        $count = ceil($len/$num);
         
        for($i=0;$i<$count;$i++)
        {
//            print_r(array_slice($adgroups_created, $i*$part, $seg));
            try{
        $data->create_adgroups(Credentials::$ACCOUNT_ID, $argv[1], array_slice($adgroups_created, $i*$part, $seg));
            }catch(Exception $e)
            {
                //to do
            }
            
        }
    }
    
   
//print_r(array_values($adgroups_created));
//exit();
    
        
//        foreach(array_chunk($adgroups_created,200) as $adgroups)
//        {
//       print_r($adgroups);
//        }
       
//        foreach(array_chunk($adgroups_created,50) as $adgroups)
//        {
//        $data->create_adgroups(Credentials::$ACCOUNT_ID, $argv[1], $adgroups);
//        }
   
    $adgroups = $data->get_adgroups(Credentials::$ACCOUNT_ID,$argv[1]);
    $adgroups_name = array();
//    print_r($adgroups);
//    exit();
    foreach($adgroups[$argv[1]] as $adg)
    {
        $adgroups_name[number_format($adg['adgroupid'], 0, '', '')] = $adg['adgroup_name'];
//        $adgroups_name[$adg['adgroupid']] = $adg['adgroup_name'];
    }
    
    
    
    foreach($dataads as $key=>$val)
    {
      $temp[array_search($key,$adgroups_name)] = $val;     
    }
    
//    $ttmp = json_encode($temp);
//    echo $ttmp;
//    $data->uploadResponsiveAds(Credentials::$ACCOUNT_ID, $temp);
//    
//    echo '<pre>';
//    echo 'To Create<br/>';
//    print_r($dataads);
//    print_r($adgroups_name);
//    print_r($temp);
//    foreach($temp as $k=>$t)
//    {
//        echo $k;
//        echo '<br/>';
//        print_r($t);
//    }
//    exit();
    $total_ads = $data->list_all_ads(Credentials::$ACCOUNT_ID,$argv[1]);
//    echo '<br/>';
//    print_r($total_ads);
//    exit();
    
    if(count($temp)>0)
    {
        if(count($total_ads)>0)
        {
    foreach($temp as $key=>$val)
    {
        
        $tmp = $total_ads[$key];
if(count($tmp)>0)
{
    $toad = array();
        foreach ($val as $v)
        {
      
        $z = 0;
            foreach($tmp as $t)
            {
                
     
                if($v['short_head']==$t['short_head'])
                {
                    $z++;
                }
                if($v['long_head']==$t['long_head'])
                {
                    $z++;
                }
                if($v['desc']==$t['desc'])
                {
                    $z++;
                }
          
            }
                  if($z<3)
        {
            $toad[$key] = $v;
        }
        }
         try {
//        echo '<br/>-------------------------****************************------------<br/>';
//        print_r($toad);
    $data->uploadResponsiveAds(Credentials::$ACCOUNT_ID, $toad);
    }catch(Exception $e)
            {
                //to do
            }
}
else
{
    $toad = array();
    $toad[$key] = $val;
    try {
//        echo '<br/>-------------------------****************************------------<br/>';
//        print_r($toad);
    $data->uploadResponsiveAds(Credentials::$ACCOUNT_ID, $toad);
    }catch(Exception $e)
            {
                //to do
            }
}
       
        
        
    }
//    try {
////        echo '<br/>-------------------------****************************------------<br/>';
////        print_r($toad);
//    $data->uploadResponsiveAds(Credentials::$ACCOUNT_ID, $toad);
//    }catch(Exception $e)
//            {
//                //to do
//            }
    //create rest aqds
        }
        else
        {
            try {
           $data->uploadResponsiveAds(Credentials::$ACCOUNT_ID, $temp);
           }catch(Exception $e)
            {
                //to do
            }
        }
    }
//    echo '<br/>';
//    echo '---------------------------------------------';
//    echo '<br/>';
//    
//    print_r($toad);
    
    
////    print_r($data->get_campaigns($accountid));
//    $data->uploadResponsiveAds(Credentials::$ACCOUNT_ID, '44629160766',$fields,$datum);
//    $data->back_To_Home();
    
    
    
} catch (Exception $ex) {
//
}
    


    
//}
<?php
    error_reporting(0);
    $data_array = file_get_contents('php://input');
    $data = json_decode($data_array, true);
    $websites = $data['websites'];
    $industries = $data['industries'];
    $fullname = $data['fullname'];
    $email = $data['email'];
    $phone = $data['phone'];
    $comments = $data['comments'];
    $selectedLinksData = $data['selectedLinksData'];
    $conetents = $data['conetents'];
    $preferredDaOne = $data['preferredDaOne'];
    $preferredDaTwo = $data['preferredDaTwo'];
    $preferredDaThree = $data['preferredDaThree'];
    $preferredDaFour = $data['preferredDaFour'];
    $isSureChecked = $data['isSureChecked'];

    if(!empty($isSureChecked) && $isSureChecked==1){
        $sure = "I am not sure.";
    }else{
        $sure = "";
    }

    if(!empty($selectedLinksData) && $selectedLinksData == "less"):
        $links_per_month = "Less than 50";
    elseif(!empty($selectedLinksData) && $selectedLinksData == "more"):
        $links_per_month = "More than 50";
    endif;

    if(!empty($conetents) && $conetents == "withcontent"):
        $conetentsData = "Yes";
    elseif(!empty($conetents) && $conetents == "withoutcontent"):
        $conetentsData = "No, I will provide the content";
    endif;

    $website_api_link = array();
    if(!empty($websites)){
        $count=1;
        foreach($websites as $row){
            $website_api_link[] = "website_".$count."=".urlencode($row);
        $count++;    
        }        
    } 
    $industries_api_link=array();
    if(!empty($industries)){
        $count=1;
        foreach($industries as $row){
            $industries_api_link[] = "industry_".$count."=".urlencode($row);
        $count++;    
        }        
    } 
    /* Insert hubspot  srtart*/				
            /*hubspot key*/
            $portalId = "2700725";
            $formGuid = "7b343eca-030d-41c1-b1af-cfd3051018d9";
        /*hubspot key*/            
        
        //Need to populate these variable with values from the form.
        $str_post = "firstname=" . urlencode($fullname) 
            . "&email=" . urlencode($email)
            . "&phone=" . urlencode($phone) 
            . "&links_per_month=" . urlencode($links_per_month) 
            . "&we_will_write_the_content_1=" . urlencode($conetentsData)
            . "&please_provide_the_preferred_da_40=" . urlencode($preferredDaOne)
            . "&please_provide_the_preferred_da_40_to_60=" . urlencode($preferredDaTwo)
            . "&please_provide_the_preferred_da_60_to_69=" . urlencode($preferredDaThree)
            . "&please_provide_the_preferred_da_70=" . urlencode($preferredDaFour) 
            . "&please_provide_the_preferred_da_i_m_not_sure=" . urlencode($sure) 
            . "&job_description=" . urlencode($comments)."&".implode('&', $website_api_link)."&".implode('&', $industries_api_link);
        //replace the values in this URL with your portal ID and your form GUID
        $endpoint = 'https://forms.hubspot.com/uploads/form/v2/'.$portalId.'/'.$formGuid;
        
        $ch = @curl_init();
        @curl_setopt($ch, CURLOPT_POST, true);
        @curl_setopt($ch, CURLOPT_POSTFIELDS, $str_post);
        @curl_setopt($ch, CURLOPT_URL, $endpoint);
        @curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response    = @curl_exec($ch); //Log the response from HubSpot as needed.
        $status_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE); //Log the response status code
        @curl_close($ch);
        echo 'statuscode:'.$status_code . " response:" . $response;

/* Insert hubspot srtart*/
?>
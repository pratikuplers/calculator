<?php
error_reporting(0);
$data_array = file_get_contents('php://input');
$data = json_decode($data_array, true);
    $fullname=$data['fullname'];
    $email=$data['email'];
    $phone=$data['phone'];
    $website=$data['website'];
    $comments = $data['comments'];
    $service = array();
    $isGoogleAdsChecked = $data['isGoogleAdsChecked'];
    $isFbInstaChecked = $data['isFbInstaChecked'];
    $isTwitterAdsChecked = $data['isTwitterAdsChecked'];
    $isYoutubeAdsChecked = $data['isYoutubeAdsChecked'];
    $isLinkedInAdsChecked = $data['isLinkedInAdsChecked'];
    $isBingAdsChecked = $data['isBingAdsChecked'];

    if($isGoogleAdsChecked==1){
        $service[]= "Google Ads";
    }
    if($isFbInstaChecked==1){
        $service[]= "Facebook & Instagram Ads";
    }
    if($isTwitterAdsChecked==1){
        $service[]= "Twitter Ads";
    }
    if($isYoutubeAdsChecked==1){
        $service[]= "Youtube Ads";
    }
    if($isLinkedInAdsChecked==1){
        $service[]= "LinkedIn Ads";
    }
    if($isBingAdsChecked==1){
        $service[]= "Bing Ads";
    }
    $service_array = implode(',', $service);
    $marketing_goals = array();
    $isSales = $data['isSales'];
    $isTraffic = $data['isTraffic'];
    $isLeads = $data['isLeads'];
    $isBrandA = $data['isBrandA'];
    $isOther = $data['isOther'];
    if($isSales==1){
        $marketing_goals[] = "Sales / Revenue";
    }
    if($isTraffic==1){
        $marketing_goals[] = "Website Traffic";
    }
    if($isLeads==1){
        $marketing_goals[] = "Leads";
    }
    if($isBrandA==1){
        $marketing_goals[] = "Brand Awareness";
    }
    if($isOther==1){
        $marketing_goals[] = "Others";
    }
    $marketing_goals_array = implode(',',$marketing_goals);
    $selectedLocations = $data['selectedLocations'];
    $isProgressChecked = $data['isProgressChecked'];
    if($isProgressChecked==1){
        $monthlyMediaPrice = $data['monthlygreaterthousand'];
    }else{
        $monthlyMediaPrice = $data['monthlyMediaPrice'];
    }
    $selectedBannerOption = $data['selectedBannerOption'];
    $selectedLandingOption = $data['selectedLandingOption'];
    /* Insert hubspot  srtart*/				
            /*hubspot key*/
                $portalId = "2700725";
                $formGuid = "e7e9ae25-81cd-4c02-a03f-86e3d4b22350";
            /*hubspot key*/            
            
            //Need to populate these variable with values from the form.
            $str_post = "firstname=" . urlencode($fullname) 
                . "&phone=" . urlencode($phone)
                . "&email=" . urlencode($email)
                . "&job_description=" . urlencode($comments)
                . "&website_1=" . urlencode($website)
                . "&services_1=" . urlencode($service_array)
                . "&marketing_goals=" . urlencode($marketing_goals_array)
                . "&locations=" . urlencode($selectedLocations)
                . "&monthly_media_spend=" . urlencode($monthlyMediaPrice)
                . "&do_you_require_banner_creatives_=" . urlencode($selectedBannerOption)
                . "&do_you_require_landing_page_=" . urlencode($selectedLandingOption); //Leave this one be
            
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
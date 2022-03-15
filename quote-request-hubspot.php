<?php
// error_reporting(0);
// WordPress environment
    require_once('../../../../wp-load.php');
/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');
    
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $website = $_POST['website'];
    $comments = $_POST['comments'];
    $addlink = $_POST['addlink'];
    $radioDemo = $_POST['radioDemo'];
    $selectedTechnology = $_POST['selectedTechnology'];
    $selectedService = $_POST['selectedService'];    
    $hometemp = $_POST['hometemp'];
    $uniquetemp = $_POST['uniquetemp'];
    $adaptiontemp = $_POST['adaptiontemp'];
    $bloglisttemp = $_POST['bloglisttemp'];
    $blogdetailtemp  = $_POST['blogdetailtemp'];
    $interactivecomponentaddon = $_POST['interactivecomponentaddon'];
    $seoservice = $_POST['seoservice'];
    $selectpckge = $_POST['selectpckge'];
    $homeTemplatePrice = $_POST['homeTemplatePrice'];
    $blogListingTemplatePrice = $_POST['blogListingTemplatePrice'];
    $blogDetailTemplatePrice = $_POST['blogDetailTemplatePrice'];
    $uniqueInnerTemplatePrice = $_POST['uniqueInnerTemplatePrice'];
    $adaptionTemplatePrice = $_POST['adaptionTemplatePrice'];
    $woocommercePrice = $_POST['woocommercePrice'];
    $interactiveComponentPrice = $_POST['interactiveComponentPrice'];
    $visualComposerPrice = $_POST['visualComposerPrice'];

    if($selectedService=="development"):
        $selectedService="Development";
    elseif($selectedService=="design_development"):
        $selectedService="Design & Development";
    endif;

    /**********************Upload attachment in media of wordpress Start********************/
        $wordpress_upload_dir = wp_upload_dir();
        // $wordpress_upload_dir['path'] is the full server path to wp-content/uploads/2017/05, for multisite works good as well
        // $wordpress_upload_dir['url'] the absolute URL to the same folder, actually we do not need it, just to show the link to file
        $i = 1; // number of tries when the file with the same name is already exists
        $profilepicture = $_FILES['image'];
        $new_file_path = $wordpress_upload_dir['path'] . '/' . $profilepicture['name'];
        $new_file_mime = mime_content_type( $profilepicture['tmp_name'] );
        
            if( empty( $profilepicture ) )
                die( 'File is not selected.' );
            
            if( $profilepicture['error'] )
                die( $profilepicture['error'] );
            
            if( $profilepicture['size'] > wp_max_upload_size() )
                die( 'It is too large than expected.' );
            
            if( !in_array( $new_file_mime, get_allowed_mime_types() ) )
                die( 'WordPress doesn\'t allow this type of uploads.' );
            
            while( file_exists( $new_file_path ) ) {
                $i++;
                $new_file_path = $wordpress_upload_dir['path'] . '/' . $i . '_' . $profilepicture['name'];
            }
            
            // looks like everything is OK
            if( move_uploaded_file( $profilepicture['tmp_name'], $new_file_path ) ) {
            
            
                $upload_id = wp_insert_attachment( array(
                    'guid'           => $new_file_path, 
                    'post_mime_type' => $new_file_mime,
                    'post_title'     => preg_replace( '/\.[^.]+$/', '', $profilepicture['name'] ),
                    'post_content'   => '',
                    'post_status'    => 'inherit'
                ), $new_file_path );
                // wp_generate_attachment_metadata() won't work if you do not include this file
                require_once( ABSPATH . 'wp-admin/includes/image.php' );
                require_once( ABSPATH . 'wp-admin/includes/file.php' );
                require_once( ABSPATH . 'wp-admin/includes/media.php' );
            
                // Generate and save the attachment metas into the database
                wp_update_attachment_metadata( $upload_id, wp_generate_attachment_metadata( $upload_id, $new_file_path ) );
                $attachement_url = wp_get_attachment_url($upload_id);
                if($radioDemo == "Sitemap"):
                    $lable = "sitemap";
                    $mUrl = $attachement_url;

                elseif($radioDemo == "Wireframe"):
                    $lable = "wireframe";
                    $mUrl = $attachement_url;

                elseif($radioDemo == "Designs"):
                    $lable = "designs";
                    $mUrl = $attachement_url;

                endif;
                // Show the uploaded file in browser
               // wp_redirect( $wordpress_upload_dir['url'] . '/' . basename( $new_file_path ) );
            
            }
    /**********************Upload attachment in media of wordpress End********************/   
    /* Insert hubspot  srtart*/				
            /*hubspot key*/
            $portalId = "2700725";
            $formGuid = "3aa140c0-eca7-44bb-8d7d-11f5db17ed9b";
        /*hubspot key*/            
        
        //Need to populate these variable with values from the form.
        $str_post = "firstname=" . urlencode($fullname) 
            . "&email=" . urlencode($email)
            . "&phone=" . urlencode($phone)                        
            . "&website_url=" . urlencode($website)
            . "&job_description=" . urlencode($comments)
            . "&technology=" . urlencode($selectedTechnology)
            . "&services=" . urlencode($selectedService)
            . "&home_template_text=" . urlencode($hometemp)
            . "&unique_templates=" . urlencode($uniquetemp)
            . "&adaptation_page=" . urlencode($adaptiontemp)
            . "&blog_details=" . urlencode($blogdetailtemp)
            . "&blog_listing=" . urlencode($bloglisttemp)
            . "&addon_s_interactive_components=" . urlencode($interactivecomponentaddon)
            . "&interested_in_seo_services_=" . urlencode($seoservice)
            . "&packages=" . urlencode($selectpckge)
            . "&home_template_text=" . urlencode($homeTemplatePrice)
            . "&unique_templates=" . urlencode($uniqueInnerTemplatePrice)
            . "&blog_details=" . urlencode($blogDetailTemplatePrice)
            . "&blog_listing=" . urlencode($blogListingTemplatePrice)
            . "&adaptation_page=" . urlencode($adaptionTemplatePrice)
            . "&addon_s_woocommerce=" . urlencode($woocommercePrice)
            . "&addon_s_interactive_components=" . urlencode($interactiveComponentPrice)
            . "&addon_s_visual_composer=" . urlencode($visualComposerPrice)
            . "&add_link=" . urlencode($addlink)
            . "&".$lable."=" . urlencode($mUrl);
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
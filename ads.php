<?php
    $query = $pdo -> query("SELECT

    ads.ad_id,

                ads.tytle_ad,
                ads.info_ad,
                ads.contact_name,
                ads.contact_phone,
                ads.date_end,
                ads.file

    FROM ads WHERE  del = 0");

    $ads = $query -> fetchAll(PDO::FETCH_ASSOC);

    if($ads){

        foreach($ads as $ad){
            $ad['date_end'] = date("d.m.Y", $ad['date_end']);
            $ads_array[] = $ad;
        }

    }
    
    else{
        $ads_array = [];
    };

    http_response_code(200);

    $response['data'] = $ads_array;

    apiResponse($response);

    exit;
<?php
    if(isset($_GET['ad']) && isset($_GET['add'])){

        if (isset($_POST['title_ad']) && 
            isset($_POST['info_ad']) &&
            isset($_POST['contact_name']) &&
            isset($_POST['contact_phone']) &&
            isset($_POST['date_end'])){

            $title_ad = $_POST['title_ad'];
            $info_ad = $_POST['info_ad'];
            $contact_name = $_POST['contact_name'];
            $contact_phone = $_POST['contact_phone'];
            $date_end = $_POST['date_end'];

            $d_end = explode(".", $date_end);

            $date_end = strtotime($d_end[0] . '-' . $d_end[1] . '-' . $d_end[2]);
            
            $ad_key = rand(1000, 9999);

            $file = '';
            $prepare = $pdo -> prepare("INSERT INTO ads(
                                        ad_key, title_ad,
                                        info_ad, contact_name,
                                        contact_phone, date_end,
                                        file, time, del)
                                        
                                        values(:ad_key,
                                        :title_ad, :info_ad,
                                        :contact_name, :contact_phone,   
                                        :date_end, :file, :time, :del)");

            $prepare -> bindValue(":ad_key", $ad_key);
            $prepare -> bindValue(":title_ad", $title_ad);
            $prepare -> bindValue(":info_ad", $info);
            $prepare -> bindValue(":contact_name", $contact_name);
            $prepare -> bindValue(":contact_phone", $contact_phone);
            $prepare -> bindValue(":date_end", $date_end);
            $prepare -> bindValue(":file", $file);
            $prepare -> bindValue(":time", $time);
            $prepare -> bindValue(":del", 0);

        };
     
    }
    apiResponse($response);

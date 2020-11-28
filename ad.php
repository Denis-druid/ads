<?php
    
    if(isset($_get['ad']) && isset($_get['proverka'])){
        if(isset($_POST['ad_id']) && isset($_POST['ad_key'])){
            $ad_id = $_POST['ad_id'];
            $ad_key = $_POST['ad_key'];
            $query = $pdo -> query("SELECT 
            ads.ad_id, 
                    ads.tytle_ad,
                    ads.info_ad,
                    ads.contact_name,
                    ads.contact_phone,
                    ads.date_end
            FROM ads WHERE ad_id = '{$ad_id}'");
            
            $ad = $query ->fetchAll(PDO::FETCH_ASSOC);

            if ($ad){
                foreach($ad as $data){
                    $ad_array[] = $ad;
                }
                
            }else{
                http_response_code(422);
                echo 'Нету';
            }
            
            

        }else{

        }

    }

    else if(isset($_GET['ad']) && ($_GET['ad'] > 0)){
        $id = $_GET['ad'];
        $query = $pdo -> query("SELECT 
        
        ads.ad_id, 
                ads.tytle_ad,
                ads.info_ad,
                ads.contact_name,
                ads.contact_phone,
                ads.date_end
        FROM ads WHERE ad_id = '{$id}'");

        $ad = $query->fetchALL(PDO::FETCH_ASSOC);

        if ($ad){
            foreach($ad as $data){

                $ad_array[] = $data;

            }
        }else{
            $ad_array = [];
        };

        http_response_code(200);

        $response['data'] = $ad_array;

        // apiResponse($response);
    }
    else if(isset($_GET['ad']) && isset($_GET['add'])){
      
        if (isset($_POST['tytle_ad']) && 
            isset($_POST['info_ad']) &&
            isset($_POST['contact_name']) &&
            isset($_POST['contact_phone']) &&
            isset($_POST['date_end'])){

            $tytle_ad = $_POST['tytle_ad'];
            $info_ad = $_POST['info_ad'];
            $contact_name = $_POST['contact_name'];
            $contact_phone = $_POST['contact_phone'];
            $date_end = $_POST['date_end'];

            $d_end = explode(".", $date_end);

            $date_end = strtotime($d_end[0] . '-' . $d_end[1] . '-' . $d_end[2]);
            
            $ad_key = rand(1000, 9999);

            $file = '';
            $prepare = $pdo -> prepare("INSERT INTO ads(
                                        ad_key, tytle_ad,
                                        info_ad, contact_name,
                                        contact_phone, date_end,
                                        file, time, del)
                                        
                                        values(:ad_key,
                                        :tytle_ad, :info_ad,
                                        :contact_name, :contact_phone,   
                                        :date_end, :file, :time, :del)");

            $prepare -> bindValue(":ad_key", $ad_key);
            $prepare -> bindValue(":tytle_ad", $tytle_ad);
            $prepare -> bindValue(":info_ad", $info_ad);
            $prepare -> bindValue(":contact_name", $contact_name);
            $prepare -> bindValue(":contact_phone", $contact_phone);
            $prepare -> bindValue(":date_end", $date_end);
            $prepare -> bindValue(":file", $file);
            $prepare -> bindValue(":time", $time);
            $prepare -> bindValue(":del", 0);
            
            $execute = $prepare -> execute();
            print_r ($prepare-> errorInfo());
            if($execute){
                
                $select_ad = $pdo ->LastInsertId();

                $response["id"] = $select_ad;
                $response["key"] = $ad_key;

                http_response_code(201);

            }else{

                $response["response"] = array("error");

                http_response_code(200);
            }

        }else{
            $response["error"] = "Ошибка, нет всех обязательных данных.";

            http_response_code(422);
        }
     
    }else{
        http_response_code(404);

        exit;
    }
    apiResponse($response);

<?php
    require("./config.php");

    if (($_SERVER["REQUEST_METHOD"] == "POST")) {
        $imageVal = json_decode(file_get_contents('php://input'), true)['imageVal'];
        $imageValUrl = rawurlencode($imageVal);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://" . X_RAPIDAPI_HOST ."/images/search?q=" . $imageValUrl . "&count=20",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: " . X_RAPIDAPI_HOST,
                "X-RapidAPI-Key: " . X_RAPIDAPI_KEY
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $data = json_decode($response, $assoc = true);
            echo json_encode($data['value']);
            //echo json_encode($data['value'][0]['contentUrl']);
        }
    }

?>
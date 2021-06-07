<?php

// require_once('../../vendor/autoload.php');
require_once("src/helpers/dotenv.php");

/**
 * Send a mail with Sendinblue. Data must be passed in JSON format
 * 
 * @param {Array} $to
 * @param {Object} $params
 * @param {String} $templateId
 */
function sendMail($to, $params, $templateId)
{
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.sendinblue.com/v3/smtp/email",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\"sender\":
        {\"name\":\"Swimrun Réunion\",\"email\":\"contact.swimrunreunion@gmail.com\"},
        \"to\":" . $to . ", \"params\":" . $params . ",
        \"templateId\":" . $templateId . "}",
        CURLOPT_HTTPHEADER => [
            "Accept: application/json",
            "Content-Type: application/json",
            "api-key: " . $_ENV["SIB_API_KEY"]
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    if ($err) {
        echo "cURL error #:" . $err;
        return false;
    } else {
        echo $response;
        return true;
    }
}

// $to = [
//     [
//         "email" => "antoineschilt@gmail.com",
//         "name" => "Antoine"
//     ],
//     [
//         "email" => "nthestripper@gmail.com",
//         "name" => "Nick TS"
//     ]
// ];

// $params = [
//     "prenom1" => "Antoine", "prenom2" => "Bob"
// ];

// $templateId = "1";

// sendMail(json_encode($to), json_encode($params), $templateId);

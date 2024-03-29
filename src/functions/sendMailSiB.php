<?php
require_once("src/helpers/dotenv.php");

/**
 * Send a mail with Sendinblue.
 * 
 * @param {Array} $to
 * @param {Array} $params
 * @param {Int} $templateId
 */

function sendMail($to, $params, $templateId)
{
    $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', $_ENV["SIB_API_KEY"]);

    $apiInstance = new SendinBlue\Client\Api\TransactionalEmailsApi(
        new GuzzleHttp\Client(),
        $config
    );

    $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail();
    $sendSmtpEmail['to'] = $to;
    $sendSmtpEmail['templateId'] = $templateId;
    $sendSmtpEmail['params'] = $params;
    $sendSmtpEmail['headers'] = [
        "Accept" => "application/json",
        "Content-Type" => "application/json",
        "api-key" => $_ENV["SIB_API_KEY"]
    ];

    try {
        $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
        print_r($result);
        return true;
    } catch (Exception $e) {
        echo "Exception when calling TransactionalEmailApi->sendTransacEmail: ", $e->getMessage(), PHP_EOL;
        return false;
    }
}
// function sendMail($to, $params, $templateId)
// {
//     $curl = curl_init();

//     curl_setopt_array($curl, [
//         CURLOPT_URL => "https://api.sendinblue.com/v3/smtp/email",
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_ENCODING => "",
//         CURLOPT_MAXREDIRS => 10,
//         CURLOPT_TIMEOUT => 30,
//         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//         CURLOPT_CUSTOMREQUEST => "POST",
//         CURLOPT_POSTFIELDS => "{\"sender\":
//         {\"name\":" . $_ENV["CONTACT_NAME"] . ",\"email\":" . $_ENV["CONTACT_MAIL"] . "},
//         \"to\":" . $to . ", \"params\":" . $params . ",
//         \"templateId\":" . $templateId . "}",
//         CURLOPT_HTTPHEADER => [
//             "Accept: application/json",
//             "Content-Type: application/json",
//             "api-key: " . $_ENV["SIB_API_KEY"]
//         ],
//     ]);

//     echo($to);

//     $response = curl_exec($curl);
//     $err = curl_error($curl);

//     if ($err) {
//         echo "cURL error #:" . $err;
//         return false;
//     } else {
//         echo $response;
//         return true;
//     }
// }

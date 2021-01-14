<?php



$title = $_GET['title'];
$messageBody = $_GET['message'];


if (isset($_GET['image'])) {
    $image = $_GET['image'];
} else {
    $image = '';
}


if (isset($_GET['type'])) {
    $type = $_GET['type'];
} else {
    $type = '1';
}

notificationAllMobileUser($title, $messageBody, $image, $type);

function notificationAllMobileUser($title, $messageBody, $image, $type)
{


    // Create at 14/01/2020 -- Devloper Mizanur Rahaman Contact - 01839688665


    define('API_ACCESS_KEY', 'AAAAZhoDi0U:APA91bEwXQbfKRoC_LUDbyqMW0Yk8B9qpVaBo5F0BlaFP8TATxsuU4nuGf8-mh-mItcOmS6C_RJal9M9Mb8QKB1uGnTpTBRzk6e3WF9oiZYgJG0JyFtirm_CTsQ2fPRgNRA_OT44hu2f');
    $fcmUrl = 'https://fcm.googleapis.com/fcm/send';

    // $token = 'f5oMxCd7Ryio_gsLeSIfnC:APA91bEHf3f0dXc_SEQY77z3vR1GAxC-1qOzKCy8lKnTubWq4yCjDufmf4DzFvsJe9V662BiZC02NV-ApRo3vBOoqZnkkBG11Ygt5XzMX4Htvcqf-aB4hkzL6W3byC35x2WFgJyYFQNK';
    // https://www.mail-signatures.com/wp-content/uploads/2019/02/How-to-find-direct-link-to-image_Fb-Picture.png

    $topic = "ibotube";
    //  $token="ffQMZevoQeSZ0X0L4hg3oR:APA91bFZs5x89xE2FTaOxqYpeCTI7cvb2WzToLBJtsw-Se1YjcWrXgC9Uneu2af5hYBciFHZ6DhquP4X-lMq56BOTflRzWsdfTfeOqvkxNTE6NzKZ-Kt8vdfTC9DuP1xr5IJI-M-I5fB";

    $notification = [
        'title' => $title,
        'body' => $messageBody,
        'id' => '0',
        'image' => $image,
        'type' => $type
    ];
    // $extraNotificationData = ["message" => $notification];

    $fcmNotification = [
        //'registration_ids' => $tokenList, //multple token array
        // 'to' => $token, //single token
        'to' => '/topics/' . $topic, //single token
        'data' => $notification
    ];

    $headers = [
        'Authorization: key=' . API_ACCESS_KEY,
        'Content-Type: application/json'
    ];


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $fcmUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
    $result = curl_exec($ch);
    curl_close($ch);


    echo $result;
}

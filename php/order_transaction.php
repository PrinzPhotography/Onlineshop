<?php

require_once ('User.php');
require_once ('Orders.php');
session_start();
$user  = new User();
$order = new Orders();
if($_POST['requirement'] === 'check_order_payable') {
    $feedback = $order->orderTransaction();
    if($feedback['zahlungsart'] && $feedback['lieferadresse']) {
        echo (json_encode(['success' => true]));
    } else {
        echo (json_encode(['success'          => false,
                           'lieferadresse'    => $feedback['lieferadresse'],
                           'zahlungsart'      => $feedback['zahlungsart']
        ]));
    }
}
if($_POST['requirement'] === 'change_zahlung') {
    $order->updateZahlung($_POST['zahlung']);
    $_SESSION['zahlung'] = $_POST['zahlung'];
    echo json_encode(['success' => true]);
}
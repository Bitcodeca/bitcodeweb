<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once '/home/bitcodeweb/public_html/phpmailer/PHPMailerAutoload.php';

if (isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['message']) && isset($_POST['numero'])) {

    //check if any of the inputs are empty
    if (empty($_POST['nombre']) || empty($_POST['email']) || empty($_POST['message'])) {
        $data = array('success' => false, 'message' => 'Please fill out the form completely.');
        echo json_encode($data);
        exit;
    }

    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';
    $mail->From = $_POST['email'];
    $mail->FromName = $_POST['nombre'];
    $mail->AddAddress('bitcodemail@gmail.com');
    $mail->Subject = 'Contacto bitcodeweb.com';
    $mail->Body = "Nombre: " . $_POST['nombre'] . "\r\n\r\nNúmero: " . $_POST['numero'] . "\r\n\r\nEmail: " . $_POST['email'] . "\r\n\r\nMensaje: " . stripslashes($_POST['message']);
    
    if(!$mail->send()) {
        $data = array('success' => false, 'message' => 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo);
        echo json_encode($data);
        exit;
    }

    $data = array('success' => true, 'message' => 'enviado');
    echo json_encode($data);

} else {
    $data = array('success' => false, 'message' => 'Por favor, termine de llenar el formulario.');
    echo json_encode($data);
}
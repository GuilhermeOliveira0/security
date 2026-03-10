<?php
include( 'aes.php' );

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$chave = "1234567890123456";

$aesUsuario = new AES($usuario, $chave, 128);
$usuario_cripto = $aesUsuario->encrypt();

$aesSenha = new AES($senha, $chave, 128);
$senha_cripto = $aesSenha->encrypt();

#http://localhost/seguranca/validarlogin_cripto.php

$url='http://192.168.100.234/cripto/post/comcripto/validarlogin.php';

$ch = curl_init($url);

$params="usuario=$usuario_cripto&senha=$senha_cripto";

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);

print_r($result);

curl_close($ch);
?>
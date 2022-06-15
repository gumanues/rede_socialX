<?php 
session_start();
include('conexao.php');

$_SESSION['chat'] = filter_input(INPUT_POST, 'id_envio', FILTER_SANITIZE_STRING);

header('Location: ../pages/batepapo.php');
<?php
require('./vendor/autoload.php');

//Dependêcias do projeto
use App\file\ImageToText;

//Verifica o post da página
if(isset($_POST['widht']) and isset($_FILES['image']))
{
    $obImageToText = new ImageToText($_FILES['image']['tmp_name']);
}
elseif ($_FILES['image']['error'] !== UPLOAD_ERR_OK) 
{
    die("Erro no upload: " . $_FILES['image']['error']);
}

//Cabeçalho da página
include('./includes/header.php');

//Formulário da página
include('./includes/form.php');

//Rodapé da página
include('./includes/footer.php');


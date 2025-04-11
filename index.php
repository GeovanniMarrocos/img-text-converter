<?php
require('./vendor/autoload.php');

//Cabeçalho da página
include('./includes/header.php');

//Dependêcias do projeto
use App\Services\ImageToText;

if(isset($_POST['widht']) and isset($_FILES['image']))
{

}


//Formulário da página
include('./includes/form.php');

//Rodapé da página
include('./includes/footer.php');


<?php
require('./vendor/autoload.php');

//Dependêcias do projeto
use App\File\ImageToText;

//Verifica o post da página
if(isset($_POST['width']) and isset($_FILES['image']))
{

    // Instancia da classe de processamento
   $obImageToText =  new ImageToText($_FILES['image']['tmp_name']);
   

  // Texto criado a apartir da imagem 
  $text = $obImageToText->getText($_POST['width']);
   
}
   
//Arquivo central da pagina 
$file = isset($text) ? 'result.php' : 'form.php';

//Cabeçalho da página
include('./includes/header.php');

//Formulário da página
include('./includes/'.$file);

//Rodapé da página
include('./includes/footer.php');



<?php 

namespace App\file;

class ImageToText
{
    /**  
     * Recurso GD library da imagem carregada  
     * @var resource  
     */  
    private $image;  

    /**  
     * Largura da imagem em pixels  
     * @var int  
     */  
    private int $width;  

    /**  
     * Altura da imagem em pixels  
     * @var int  
     */  
    private int $height;

    // Métodos virão aqui...

    /**  
     * Método responsável por carregar a imagem na classe 
     * @param string $file 
     */  
    public function __construct($file)
    {
       // Carrega a imagem com a biblioteca GD
       $this->image = imagecreatefromstring(file_get_contents($file));
       
       list($this->width, $this->height) = getimagesize($file);

       "<pre>";
        print_r($this);
       "</pre>";
       
    }
}


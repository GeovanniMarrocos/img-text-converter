<?php 

namespace App\Services;

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
        echo "<pre>";
            dump($file);
        echo "<pre>";
        exit;
    }
}


<?php

namespace App\File;

use GdImage;
use RuntimeException;
use InvalidArgumentException, finfo;

class ImageToText
{

    private \GdImage $image;
    private int $width;
    private int $height;

    /**  
     * Método responsável por carregar a imagem na classe 
     * @param string $file 
     */
    public function __construct(string $file)
    {
        // Verifica se o arquivo existe primeiro
        if (!file_exists($file)) {
            throw new InvalidArgumentException("Arquivo de imagem não encontrado: " . $file);
        }

        // Obtém informações do arquivo
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($file);

        if ($mimeType === 'application/pdf') {
            throw new RuntimeException("PDF não é suportado como imagem. Por favor, envie um arquivo JPEG, PNG ou GIF.");
        }

        //Carrega a imagem com a biblioteca GD
         $this->image = imagecreatefromstring(file_get_contents($file));

        //Largura e altura da imagem
        list($this->width, $this->height) = getimagesize($file);

        //Converte a imagem em escala de cinza
        $this->setGrayScale();

        $this->getImage();
        
        $this->__destruct();
    }
    /**
     * Método responsável por transformar a imagem em escala de cinza
     * 
     */
    private function setGrayScale()
    {
        imagefilter($this->image, IMG_FILTER_GRAYSCALE);
        imagefilter($this->image, IMG_FILTER_CONTRAST,-10);
    }

    private function getImage()
    {
        imagepng($this->image);
    }

    

    private function getResizedImage($newHeigth, &$newHeigth)
    {

    }

   /**
    * Método responsável por retornar a imagem convertida em texto
    * @param int $newWidth
    * @return string
    */
    public function getText($newWidth)
    {
        //Imagem redimensionada
        $image = $this->getResizedImage($newWidth, $newHeigth);
    }

    public function __destruct()
    {
        if (is_resource($this->image)) {
           imagedestroy($this->image);
        }
    }


}

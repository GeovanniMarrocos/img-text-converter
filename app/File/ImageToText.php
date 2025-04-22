<?php

namespace App\File;

use GdImage;
use RuntimeException;
use finfo;

class ImageToText
{
    /**  
     * Caracteres utilizados no conversor 
     * @var array 
     */
    const CHARS = [
        '#',
        '=',
        '%',
        '*',
        ' '
    ];

    private \GdImage $image;
    private int $width;
    private int $height;

    /**  
     * Método responsável por carregar a imagem na classe 
     * @param string $file 
     */
    public function __construct(string $file)
    {
        // Verifica se o arquivo existe
        if (!file_exists($file)) {
            throw new RuntimeException("Arquivo de imagem não encontrado: " . $file);
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

        //  $this->getImage();
        
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

    /**
    * Método responsável por redimensionar a imagem a ser convertida
    * @param int $newWidth
    * @param int $newHeigth
    * @return resource
    */
     private function getResizedImage($newWidth,&$newHeigth)
     {
        // Proporção original da image 
        $ratio = $this->width/$this->height;

        // Nova altura da imagem 
        $newHeigth = round(($newWidth / $ratio)/2);

        //Retorna a imagem redimensionada
        return imagescale($this->image,$newWidth,$newHeigth);
        
    }

    /**
    * Método responsável por retornar a imagem convertida em texto
    * @param int $newWidth
    * @return string
    */
    public function getText($newWidth)
    {
        //Imagem redimensionada 
        $image = $this->getResizedImage($newWidth,$newHeigth);

        //Texto da imagem
        $text = '';

        //Pecorre todos os pixels da imagem 
        for($y = 0; $y < $newHeigth; $y++){
           for($x = 0; $x < $newWidth; $x++){
            $text .= $this->getChar($image,$x,$y);
          }
          //Quebra linha ao final do eixo x
          $text .= PHP_EOL;
       }
        //Retorna o texto criado
          return trim($text, PHP_EOL);
         
    }

    /**
    * Método responsável por obter a cor do caractere do pixel atual
    * @param Gdimage $image
    * @param int  $x
    * @param int  $y
    * @return int
    */
    private function getPixelColor($image, $x,$y)
    {
        // Indice da cor
        $index = imagecolorat($image,$x,$y);

        // Cores do indice
        $color = imagecolorsforindex($image,$index);
        
        // Retorna a intencidade da cor
        return $color['red'] ?? 0;

    }

    /**
    * Método responsável por obter o caractere de um pixel
    * @param resource $image
    * @param int  $x
    * @param int  $y
    * @return string
    */
    private function getChar($image,$x,$y)
    {
        //Cor do pixel
        $color = $this->getPixelColor($image,$x,$y);

        //Faixa de intensidade de cor
        $range = (255 / count(self::CHARS));

        //Indice do caractere da cor atual
        $index = floor($color / $range);
        
        //Retorna o caractere
        return self::CHARS[$index] ?? ' ';
        
    }
}

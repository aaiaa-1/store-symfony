<?php 

namespace App\Service;

use Exception;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PictureService
{
    private $params;
    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function add(UploadedFile $picture , ?string $folder ='', 
                        ?int $width = 250, ?int $height = 250)
    {
        //on donne un nouveau nom à l'image
        $fichier =md5(uniqid(rand(),true)).'.webp';

        //récuperation des infos de l'image
        $pictureinfos = getimagesize($picture);
        if ($pictureinfos === false) {
            throw new Exception('Image Format Incorrect');
        }

        //vérification de format de l'image
       
    }
}
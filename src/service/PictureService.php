<?php
namespace App\service;

use mysql_xdevapi\Exception;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PictureService{
    private $params;
    public function __construct(ParameterBagInterface $params)
    {
        $this->params=$params;
    }
    public function add(UploadedFile $picture,?string $folder='',?int $width=250,?int $height = 250){
            $fichier = md5(uniqid(rand(),true)).'.webp';
            $picture_infos = getimagesize($picture);
            if($picture_infos === false){
                throw new Exception('forma d\ image incorrect');
            }
            switch ($picture_infos['mime']){
                case 'image/png':
                    $picture_source = imagecreatefrompng($picture);
                    break;
                case 'image/jpeg':
                    $picture_source = imagecreatefromjpeg($picture);
                case'image/webp':
                    $picture_source = imagecreatefromwebp($picture);
                default:throw new \Exception('format d\'image incorrect');
            }
            $imagewidth = $picture_infos[0];
            $imageheight =$picture_infos[1];

            switch($imagewidth <=> $imageheight){
                case -1:
                    $squaresize = $imagewidth;
                    $src_x = 0;
                    $src_y = ($imageheight - $imagewidth) /2;
                    break;
                case 0:
                    $squaresize = $imagewidth;
                    $src_x = 0;
                    $src_y = 0;
                    break;
                case 1:
                    $squaresize = $imageheight;
                    $src_x = ($imageheight - $imagewidth) /2;
                    $src_y = 0;
                    break;
            }
            $resuzed_picture  = imagecreatetruecolor($width,$height);
            imagecopyresampled($resuzed_picture,$picture_source,0,0,$src_x,$src_y,$width,$height,$squaresize,$squaresize);
            $path = $this->params->get('images_directory'). $folder;

            if(!file_exists($path . '/mini/')){
                mkdir($path . '/mini/',0755,true);
            }
            imagewebp($resuzed_picture,$path.'/mini/' .$width .'x'.$height .$fichier);
            $picture->move($path . '/',$fichier);
            return $fichier;

    }
    public function delete(string $ficher , ?string $folder='',?int $width=250,?int $height = 250){
            if($ficher !=='default.webp'){
                $success = false;
                $path = $this->params->get('images_directory'). $folder;
                $mini = $path .'/mini/' . $width .'x'.$height.'-' .$ficher;
                if(file_exists($mini)){
                    unlink($mini);
                    $success =true;
                }
                $original =$path .'/' . $ficher;
                if(file_exists($original)){
                    unlink($original);
                    $success =true;
                }
            }
        return $success;
    }
}
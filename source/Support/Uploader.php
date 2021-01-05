<?php


namespace Source\Support;


use CoffeeCode\Uploader\Image;

class Uploader
{
    private $fileName;

    public function uploadImage(array $data, array $file, string $name)
    {
        $imageType = explode('.', $file[$name])[1];
        $allowedTypes = [
            "image/jpg",
            "image/jpeg",
            "image/png",
            "application/pdf"
        ];
        $date = new \DateTime("now");
        $newFileName = $data['name'] . "-" . $date->getTimestamp() . "." . $imageType;
        $this->fileName = $newFileName;
        if ($file) {
            if (in_array($file['type'], $allowedTypes)) {
                move_uploaded_file($file['tmp_name'],
                    CONF_UPLOAD_DIR . "/" . CONF_UPLOAD_DIR_IMAGES . "/" . $newFileName);
            }
        }
    }

    public function fileName()
    {
        return $this->fileName;
    }


}
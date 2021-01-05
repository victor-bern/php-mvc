<?php


namespace Source\Support;


use CoffeeCode\Cropper\Cropper;

class Images
{
    private $cropper;
    private $upload;

    public function __construct()
    {
        $this->cropper = new Cropper(CONF_IMAGE_CACHE);
        $this->upload = CONF_DIR_IMAGES;
    }

    public function make(string $image, int $width): ?string
    {
        return $this->cropper->make("{$this->upload}/{$image}", $width);
    }
}
<?php

class ImageConverter
{
    /** @var array */
    private $imageFormat = [
        'gif',
        'jpeg',
        'jpg',
        'png',
        'webp',
    ];

    /** @var array */
    private $constImageFormat = [
        IMAGETYPE_GIF => 'gif',
        IMAGETYPE_JPEG => 'jpeg',
        IMAGETYPE_PNG => 'png',
        IMAGETYPE_WEBP => 'webp',
    ];

    /**
     * Do image conversion work
     *
     * @param string $from
     * @param string $to
     *
     * @return resource
     * @throws \InvalidArgumentException
     */
    public function convert($from, $to, $quality = null)
    {
        $image = $this->loadImage($from);
        if (!$image) {
            ShowMessage(['TYPE' => 'ERROR', 'MESSAGE' => sprintf('Cannot load image from %s', $from)]);
            //throw new \InvalidArgumentException(sprintf('Cannot load image from %s', $from));
        }

        return $this->saveImage($to, $image, $quality);
    }

    private function loadImage($from)
    {
        $extension = $this->getRealExtension($from);

        if (!array_key_exists($extension, $this->constImageFormat)) {
            ShowMessage(['TYPE' => 'ERROR', 'MESSAGE' => sprintf('The %s extension is unsupported', $extension)]);
            //throw new \InvalidArgumentException(sprintf('The %s extension is unsupported', $extension));
        }

        $format = $this->constImageFormat[$extension];

        switch ($format) {
            case 'gif':
                $image = imagecreatefromgif($from);
                break;
            case 'jpg':
            case 'jpeg':
                $image = imagecreatefromjpeg($from);
                break;
            case 'png':
                $image = imagecreatefrompng($from);
                break;
            case 'webp':
                $image = imagecreatefromwebp($from);
                break;
            default:
                $image = null;
        }
        return $image;
    }

    private function saveImage($to, $image, $quality)
    {
        $extension = $this->getExtension($to);

        if ($extension === 'jpg') {
            $extension = 'jpeg';
        }

        if (!in_array($extension, $this->imageFormat)) {
            ShowMessage(['TYPE' => 'ERROR', 'MESSAGE' => sprintf('The %s extension is unsupported', $extension)]);
            //throw new \InvalidArgumentException(sprintf('The %s extension is unsupported', $extension));
        }
        if (!file_exists(dirname($to))) {
            $this->makeDirectory($to);
        }

        if(isset($quality) && !is_int($quality)) {
            ShowMessage(['TYPE' => 'ERROR', 'MESSAGE' => sprintf('The %s quality has to be an integer', $quality)]);
            //throw new \InvalidArgumentException(sprintf('The %s quality has to be an integer', $quality));
        }

        switch ($extension) {
            case 'gif':
                $image = imagegif($image, $to);
                break;
            case 'jpg':
            case 'jpeg':
                if ($quality < -1 && $quality > 100) {
                    ShowMessage(['TYPE' => 'ERROR', 'MESSAGE' => sprintf('The %s quality is out of range', $quality)]);
                    //throw new \InvalidArgumentException(sprintf('The %s quality is out of range', $quality));
                }
                $image = imagejpeg($image, $to, $quality);
                break;
            case 'png':
                if ($quality < -1 && $quality > 9) {
                    ShowMessage(['TYPE' => 'ERROR', 'MESSAGE' => sprintf('The %s quality is out of range', $quality)]);
                    //throw new \InvalidArgumentException(sprintf('The %s quality is out of range', $quality));
                }
                $image = imagepng($image, $to, $quality);
                break;
            case 'bmp':
                if ($quality < -1 && $quality > 9) {
                    ShowMessage(['TYPE' => 'ERROR', 'MESSAGE' => sprintf('The %s quality is out of range', $quality)]);
                    //throw new \InvalidArgumentException(sprintf('The %s quality is out of range', $quality));
                }
                $image = imagebmp($image, $to, $quality);
                break;
            case 'webp':
                if ($quality < 0 || $quality > 100) {
                    ShowMessage(['TYPE' => 'ERROR', 'MESSAGE' => sprintf('The %s quality is out of range', $quality)]);
                    //throw new \InvalidArgumentException(sprintf('The %s quality is out of range', $quality));
                }

                if ($extension == 'gif') {
                    $image = imagecreatefromgif($image);
                } else if ($extension == 'jpeg' or $extension == 'jpg') {
                    $image = imagecreatefromjpeg($image);
                } else if ($extension == 'png') {
                    $image = imagecreatefrompng($image);
                }

                if (!empty($image)) {
                    imagepalettetotruecolor($image);
                    imagealphablending($image, true);
                    imagesavealpha($image, true);

                    $image = imagewebp($image, $to, $quality);
                }
                break;
            default:
                $image = null;
        }

        return $image;
    }

    /**
     * Given specific $path to detect current image extension
     */
    private function getRealExtension($path)
    {
        $extension = exif_imagetype($path);

        if (!array_key_exists($extension, $this->constImageFormat)) {
            ShowMessage(['TYPE' => 'ERROR', 'MESSAGE' => sprintf('Cannot detect %s extension', $path)]);
            //throw new \InvalidArgumentException(sprintf('Cannot detect %s extension', $path));
        }

        return $extension;
    }

    /**
     * Get image extension from specific $path
     *
     * @param string $path
     *
     * @return string
     */
    private function getExtension($path)
    {
        $pathInfo = pathinfo($path);

        if (!array_key_exists('extension', $pathInfo)) {
            ShowMessage(['TYPE' => 'ERROR', 'MESSAGE' => sprintf('Cannot find extension from %s', $path)]);
            //throw new \InvalidArgumentException(sprintf('Cannot find extension from %s', $path));
        }

        return $pathInfo['extension'];
    }

    /**
     * Try creating the directory
     *
     * @return bool
     * @throws \InvalidArgumentException
     */
    private function makeDirectory($to)
    {
        $result = @mkdir(dirname($to), 0755);

        if (!$result) {
            ShowMessage(['TYPE' => 'ERROR', 'MESSAGE' => sprintf('Cannot create %s directory', $to)]);
            //throw new \InvalidArgumentException(\sprintf('Cannot create %s directory', $to));
        }

        return $result;
    }
}
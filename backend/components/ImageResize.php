<?php


namespace backend\components;


use yii\base\Component;
use Intervention\Image\ImageManager;

class ImageResize extends Component
{
    /*
     * @param string $filePath
     */
public function resizeImage(string $filePath)
{
    $manager = new ImageManager();
    $manager->make($filePath)->fit(220, 68)->save($filePath);
}
}
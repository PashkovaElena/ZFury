<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 12/4/14
 * Time: 3:38 PM
 */

namespace Media\Form;

use Zend\InputFilter;
use Zend\Form\Form;
use Zend\Form\Element;

class ImageUpload extends Form
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        $this->addElements();
    }

    public function addElements()
    {
        $file = new Element\File('image');
        $file->setLabel('Image Upload')
            ->setAttribute('id', 'image');
        $this->add($file);
    }
}
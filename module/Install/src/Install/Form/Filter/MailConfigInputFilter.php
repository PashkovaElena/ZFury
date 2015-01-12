<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 12/20/14
 * Time: 10:26 AM
 */

namespace Install\Form\Filter;

use Zend\InputFilter\InputFilter;

class MailConfigInputFilter extends InputFilter
{
    public function __construct($sm, $userId = null)
    {
        $this->add([
            'name'     => 'host',
            'required' => true,
            'filters'  => [
                ['name' => 'StripTags'],
                ['name' => 'StringTrim'],
            ],
            'validators' => [
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min'      => 2,
                        'max'      => 40,
                    ],
                ],
            ],
        ]);

        $this->add([
            'name'     => 'port',
            'required' => true,
            'filters'  => [
                ['name' => 'Int'],
            ],
            'validators' => [
                [
                    'name' => 'Between',
                    'otions' => [
                        'min' => 1,
                        'max'=> 65535
                    ]
                ],
            ],
        ]);

        $this->add([
            'name'     => 'header',
            'required' => false,
        ]);

        $this->add([
            'name' => 'emails',
            'required' => false
        ]);

        $this->add([
            'name' => 'from',
            'required' => false
        ]);
    }
}

<?php
/*
* This file is part of the Zend Log Doctrine Writer module
*
* For license information, please view the LICENSE file that was distributed with this source code.
* Written by Frank Houweling <fhouweling@senet.nl>, 8/9/2017
*/


namespace FrankHouweling\ZendLogDoctrineWriter;

/**
 * Class Module
 * @package FrankHouweling\ZendLogDoctrineWriter
 */
class Module
{
    /**
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
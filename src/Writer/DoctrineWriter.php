<?php
/*
* Copyright (C) Senet Eindhoven B.V. - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
* Written by Frank Houweling <fhouweling@senet.nl>, 8/9/2017
*/

namespace FrankHouweling\ZendLogDoctrineWriter\Writer;

use Doctrine\ORM\EntityManager;
use Zend\Hydrator\ClassMethods;
use Zend\Log\Writer\AbstractWriter;

/**
 * Class DoctrineWriter
 * @package FrankHouweling\ZendLogDoctrineWriter\Writer
 */
class DoctrineWriter extends AbstractWriter
{
    /** @var EntityManager $entityManager */
    private $entityManager;

    /** @var string $entityClass */
    private $entityClass;

    /** @var array */
    private $mapping;

    /**
     * DoctrineWriter constructor.
     * @param array|null|\Traversable $entityClass
     * @param null $options
     */
    public function __construct(EntityManager $em, $entityClass, $mapping = null, $options = null)
    {
        if(!class_exists($entityClass))
        {
            throw new \InvalidArgumentException('EntityClass should be a valid classname.');
        }

        $this->entityClass = $entityClass;
        $this->entityManager = $em;
        $this->mapping = $mapping;

        parent::__construct($options);
    }

    /**
     * @param array $event
     */
    protected function doWrite(array $event)
    {
        if($this->mapping !== null)
        {
            $event = $this->mapEvent($event, $this->mapping);
        }

        $hydrator = new ClassMethods();
        $entityClass = $this->entityClass;
        $entity = new $entityClass;
        $hydrator->hydrate($event, $entity);

        $this->entityManager->persist($entity);
    }

    /**
     * @param array $data
     * @return array
     */
    private function mapEvent(array $data, $mapping)
    {
        $newData = [];
        foreach($data as $key => $value)
        {
            $newKey = $key;
            if(isset($mapping[$key]))
            {
                $newKey = $mapping[$key];
            }
            $newData[$newKey] = $value;
        }
        return $newData;
    }
}
<?php
namespace AtansCommon\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class ObjectManager extends AbstractPlugin
{
    /**
     * Returns object manager
     *
     * @param  string $objectManager
     * @return \Doctrine\ORM\EntityManager
     */
    public function __invoke($objectManager = 'doctrine.entitymanager.orm_default')
    {
        return $this->getController()->getServiceLocator()->get($objectManager);
    }
}
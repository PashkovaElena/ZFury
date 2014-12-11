<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 12/3/14
 * Time: 4:52 PM
 */

namespace Starter\Media;

use Doctrine\ORM\Event\LifecycleEventArgs;

trait Image
{
    public abstract function getEntityName();

    public abstract function setLifecycleArgs(LifecycleEventArgs $args);

    /**
     * Returns an array of ids
     *
     * @return mixed
     */
    public function getImages()
    {
        $qb = $this->lifecycleArgs->getEntityManager()->createQueryBuilder();
        $subQb = $this->lifecycleArgs->getEntityManager()->createQueryBuilder();
        $subQb->select('oi.imageId')
            ->from('Media\Entity\ObjectImage', 'oi')
            ->where('oi.entityName=:name')
            ->andWhere('oi.objectId=:id')
            ->setParameter('name', $this->getEntityName())
            ->setParameter('id', $this->id);
        $results = $subQb->getQuery()->getResult();
        foreach ($results as $result) {
            array_push($results, $result['imageId']);
            array_shift($results);
        }

        $qb->select('i')
            ->from('Media\Entity\Image', 'i')
            ->where($qb->expr()->in('i.id', $results));

        return $qb->getQuery()->getResult();
    }
}

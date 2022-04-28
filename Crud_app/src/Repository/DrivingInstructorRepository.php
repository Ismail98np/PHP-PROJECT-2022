<?php

namespace App\Repository;

use App\Entity\DrivingInstructor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DrivingInstructor|null find($id, $lockMode = null, $lockVersion = null)
 * @method DrivingInstructor|null findOneBy(array $criteria, array $orderBy = null)
 * @method DrivingInstructor[]    findAll()
 * @method DrivingInstructor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DrivingInstructorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DrivingInstructor::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(DrivingInstructor $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(DrivingInstructor $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return DrivingInstructor[] Returns an array of DrivingInstructor objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DrivingInstructor
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

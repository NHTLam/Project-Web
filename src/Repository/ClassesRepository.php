<?php

namespace App\Repository;

use App\Entity\Classes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Classes>
 *
 * @method Classes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Classes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Classes[]    findAll()
 * @method Classes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClassesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Classes::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Classes $entity, bool $flush = true): void
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
    public function remove(Classes $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
      * @return Classes[] 
    */
    public function sortByIdAsc()
    {
        return $this->createQueryBuilder('class')
                    ->orderBy('class.id', 'ASC')
                    ->getQuery()
                    ->getResult()
        ;
    }

    /**
      * @return Classes[] 
    */
    public function sortByIdDesc()
    {
        return $this->createQueryBuilder('class')
                    ->orderBy('class.id', 'DESC')
                    ->getQuery()
                    ->getResult()
        ;
    }
    
    /**
      * @return Classes[] 
    */
    public function sortByNameAsc()
    {
        return $this->createQueryBuilder('class')
                    ->orderBy('class.name', 'ASC')
                    ->getQuery()
                    ->getResult()
        ;
    }

    /**
      * @return Classes[] 
    */
    public function sortByNameDesc()
    {
        return $this->createQueryBuilder('class')
                    ->orderBy('class.name', 'DESC')
                    ->getQuery()
                    ->getResult()
        ;
    }

    /**
      * @return Classes[] 
    */
    public function sortByNumberOfStudentAsc()
    {
        return $this->createQueryBuilder('class')
                    ->orderBy('class.StdQuantity', 'ASC')
                    ->getQuery()
                    ->getResult()
        ;
    }

    /**
      * @return Classes[] 
    */
    public function sortByNumberOfStudentDesc()
    {
        return $this->createQueryBuilder('class')
                    ->orderBy('class.StdQuantity', 'DESC')
                    ->getQuery()
                    ->getResult()
        ;
    }

    /**
     * @return Classes[]
     */
    public function searchByName($keyword)  
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.name LIKE :value')
            ->setParameter('value', '%' . $keyword . '%')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Classes[] Returns an array of Classes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Classes
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

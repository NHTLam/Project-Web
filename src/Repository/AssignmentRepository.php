<?php

namespace App\Repository;

use App\Entity\Assignment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Assignment>
 *
 * @method Assignment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Assignment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Assignment[]    findAll()
 * @method Assignment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssignmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Assignment::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Assignment $entity, bool $flush = true): void
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
    public function remove(Assignment $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @return Assignment[]
     */
    public function sortByDeadlineAscending()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.deadline', "ASC")
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Assignment[]
     */
    public function sortByDeadlineDescending()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.deadline', "DESC")
            ->getQuery()
            ->getResult()
        ;
    }

    /**
    * @return Assignment[]
    */
    public function searchByTitle($title)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.Title LIKE :Title')
            ->setParameter('Title', '%'. $title . '%')
            ->orderBy('a.id', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
        ;
    }
}

<?php

namespace App\Repository;

use App\Entity\UserGroupMember;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UserGroupMember|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserGroupMember|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserGroupMember[]    findAll()
 * @method UserGroupMember[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserGroupMemberRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserGroupMember::class);
    }

    // /**
    //  * @return UserGroupMember[] Returns an array of UserGroupMember objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserGroupMember
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

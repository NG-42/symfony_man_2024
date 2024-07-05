<?php

namespace App\Repository;

use App\Entity\Reto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Reto>
 *
 * @method Reto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reto[]    findAll()
 * @method Reto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RetoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reto::class);
    }

//    /**
//     * @return Reto[] Returns an array of Reto objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Reto
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

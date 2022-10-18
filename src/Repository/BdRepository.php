<?php

namespace App\Repository;

use App\Entity\Bd;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Bd>
 *
 * @method Bd|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bd|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bd[]    findAll()
 * @method Bd[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bd::class);
    }

    public function add(Bd $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Bd $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    public function fetchBdUser(int $user_id)
    {

        return $this->createQueryBuilder('b')
            ->innerJoin('b.users', 'u')
            
            // Pour joindre les deux tables je passe par la propriété "users" de App/Entity/Bd car 
            //le QueryBuilder ne peut pas faire appel à la table intermédiaire user_bd.
            
            ->Where(':user_id = u.id')
            ->setParameter(':user_id', $user_id)
            ->orderBy('b.author', 'ASC')
            ->getQuery()
            ->getResult();
    }


//    /**
//     * @return Bd[] Returns an array of Bd objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Bd
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

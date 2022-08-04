<?php

namespace App\Repository;

use App\Entity\Lineup;
use App\Entity\Player;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @extends ServiceEntityRepository<Lineup>
 *
 * @method Lineup|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lineup|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lineup[]    findAll()
 * @method Lineup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LineupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lineup::class);
    }

    public function add(Lineup $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Lineup $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @param UserInterface $user
     * @return Lineup[]
     */
    public function findByUser(UserInterface $user): array
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.user = :user')
            ->setParameter('user', $user)
            ->orderBy('l.updatedAt', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findByUserAndMatchday(UserInterface $user, int $matchDay): ?Lineup
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.user = :user')
            ->setParameter('user', $user)
            ->andWhere('l.matchday = :matchday')
            ->setParameter('matchday', $matchDay)
            ->orderBy('l.updatedAt', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
//    /**
//     * @return Lineup[] Returns an array of Lineup objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Lineup
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

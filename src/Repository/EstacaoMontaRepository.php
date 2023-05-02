<?php

namespace App\Repository;

use App\Entity\EstacaoMonta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EstacaoMonta>
 *
 * @method EstacaoMonta|null find($id, $lockMode = null, $lockVersion = null)
 * @method EstacaoMonta|null findOneBy(array $criteria, array $orderBy = null)
 * @method EstacaoMonta[]    findAll()
 * @method EstacaoMonta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstacaoMontaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EstacaoMonta::class);
    }

    public function save(EstacaoMonta $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(EstacaoMonta $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return EstacaoMonta[] Returns an array of EstacaoMonta objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?EstacaoMonta
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

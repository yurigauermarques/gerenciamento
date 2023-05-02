<?php

namespace App\Repository;

use App\Entity\EtapaEstacaoMonta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EtapaEstacaoMonta>
 *
 * @method EtapaEstacaoMonta|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtapaEstacaoMonta|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtapaEstacaoMonta[]    findAll()
 * @method EtapaEstacaoMonta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtapaEstacaoMontaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtapaEstacaoMonta::class);
    }

    public function save(EtapaEstacaoMonta $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(EtapaEstacaoMonta $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return EtapaEstacaoMonta[] Returns an array of EtapaEstacaoMonta objects
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

//    public function findOneBySomeField($value): ?EtapaEstacaoMonta
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

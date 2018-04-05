<?php

namespace App\Repository;

use App\Entity\Port;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Port|null find($id, $lockMode = null, $lockVersion = null)
 * @method Port|null findOneBy(array $criteria, array $orderBy = null)
 * @method Port[]    findAll()
 * @method Port[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PortRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Port::class);
    }



    public function findAllQueryBuilder($filter = '')
    {
        $qb = $this->createQueryBuilder('port');
        if ($filter) {
            $qb->andWhere('port.portName LIKE :filter OR port.description LIKE :filter OR port.ingredients LIKE :filter')
                ->setParameter('filter', '%'.$filter.'%');
        }
        return $qb;
    }

    public function findAllByDateQueryBuilder($date1 = '', $date2='')
    {
        $qb = $this->createQueryBuilder('port');
        if ($date1 && $date2) {
            $qb->andWhere('port.date BETWEEN :date1 AND :date2')
                ->setParameter('date1', $date1->format('Y-m-d'))
                ->setParameter('date2', $date2->format('Y-m-d'));
        }

        return $qb;
    }

    /*
  public function findBySomething($value)
  {
      return $this->createQueryBuilder('p')
          ->where('p.something = :value')->setParameter('value', $value)
          ->orderBy('p.id', 'ASC')
          ->setMaxResults(10)
          ->getQuery()
          ->getResult()
      ;
  }
  */


}

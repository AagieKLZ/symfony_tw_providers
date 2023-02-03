<?php

namespace App\Repository;

use App\Entity\Entry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Entry|null find($id, $lockMode = null, $lockVersion = null)
 * @method Entry|null findOneBy(array $criteria, array $orderBy = null)
 * @method Entry[]    findAll()
 * @method Entry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Entry::class);
    }

    public function getEntries($page)
    {
        return $this->createQueryBuilder('e')
            ->setMaxResults(10)
            ->setFirstResult(($page - 1) * 10)
            ->getQuery()
            ->getResult();
    }

    public function getPages()
    {
        $n = $this->createQueryBuilder('e')
            ->select('count(e.id)')
            ->getQuery()
            ->getSingleScalarResult();
        return ceil($n / 10);
    }

    public function getEntry($id)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function addEntry(Entry $entry)
    {
        $this->_em->persist($entry);
        $this->_em->flush();
    }

    public function updateEntry($id, Entry $entry)
    {
        $entry->setId($id);
        $this->_em->flush();
    }

    public function deleteEntry($id)
    {
        $entry = $this->getEntry($id);
        if (!$entry) {
            throw new Exception("No Entry with id $id found");
        }
        $this->_em->remove($entry);
        $this->_em->flush();
    }
}
<?php

namespace App\Repository;

use App\Entity\Tutorial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tutorial>
 *
 * @method Tutorial|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tutorial|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tutorial[]    findAll()
 * @method Tutorial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TutorialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tutorial::class);
    }

    public function save(Tutorial $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Tutorial $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    /**
     * @param string $slug
     * @return Tutorial[]
     */
    public function findBySlug(string $slug): array
    {
        return $this->createQueryBuilder('t')
                    ->where('t.slug = :slug')
                    ->setParameters(["slug" => $slug])
                    ->getQuery()->getResult();
    }
}

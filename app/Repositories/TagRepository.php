<?php

namespace App\Repositories;

use App\Entities\Tag;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Class TagRepository
 * @package App\Repositories
 *
 * @property EntityManager $em
 */
class TagRepository extends EntityRepository
{
    /** @var EntityManager $em */
    private $em;

    public function __construct(EntityManager $em, $meta)
    {
        parent::__construct($em, $meta);
        $this->em = $em;
    }

    /**
     * Add tag
     *
     * @param array $request
     * @throws \Doctrine\ORM\ORMException
     */
    public function add(array $request)
    {
        $tag = new Tag();
        $tag->setTitle($request['title']);
        $tag->setSlug($request['title']);

        $this->em->persist($tag);
    }

    /**
     *  Update tag
     *
     * @param array $request
     * @param int $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function update(array $request, int $id)
    {
        $tag = $this->em->find(Tag::class, $id);
        $tag->setTitle($request['title']);
        $tag->setSlug($request['title']);

        $this->em->persist($tag);
    }

    /**
     *  Delete tag
     *
     * @param int $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function delete(int $id)
    {
        $tag = $this->em->find(Tag::class, $id);
        $this->em->remove($tag);
    }

    /**
     * Select id and title tags
     *
     * @return mixed
     */
    public function selectIdAndTitle()
    {
        $query = 'SELECT c.id, c.title FROM App\Entities\Tag c';
        return $this->em->createQuery($query)
            ->getResult();
    }
}

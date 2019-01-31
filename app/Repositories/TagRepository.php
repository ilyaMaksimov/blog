<?php

namespace App\Repositories;

use App\Entities\Tag;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class TagRepository extends EntityRepository
{
    private $entityName = 'App\Entities\Tag';

    /** @var EntityManager $em */
    private $em;

    public function __construct(EntityManager $em, $meta)
    {
        parent::__construct($em, $meta);
        $this->em = $em;
    }

    /**
     * @param $request
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function add($request)
    {
        /** @var Tag $tag */
        $tag = new Tag();
        $tag->setTitle($request['title']);
        $tag->setSlug($request['title']);

        $this->em->persist($tag);
        $this->em->flush();
    }

    /**
     * @param $request
     * @param $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function update($request, $id)
    {
        $tag = $this->em->find($this->entityName, $id);
        $tag->setTitle($request['title']);
        $tag->setSlug($request['title']);

        $this->em->persist($tag);
        $this->em->flush();
    }

    /**
     * @param $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function delete($id)
    {
        $tag = $this->em->find($this->entityName, $id);

        $this->em->remove($tag);
        $this->em->flush();
    }

    // todo метод как в категорирепозитори
    public function getArrayOfIdAndTitle()
    {
        $resultQuery = $this->em->createQuery('select c.id, c.title from App\Entities\Tag c')->getResult();

        $result = [];
        foreach ($resultQuery as $category) {
            $result[$category['id']]= $category['title'];
        }

        return $result ;
    }
}

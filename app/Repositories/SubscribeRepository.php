<?php

namespace App\Repositories;

use App\Entities\Subscribe;
use App\Entities\Tag;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class SubscribeRepository extends EntityRepository
{
    const ENTITY_NAME = 'App\Entities\Subscribe';

    /** @var EntityManager $em */
    private $em;

    public function __construct(EntityManager $em, $meta)
    {
        parent::__construct($em, $meta);
        $this->em = $em;
    }

    /**
     * @param $request
     * @return Subscribe
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function add($request)
    {
        /** @var Subscribe $subscribe */
        $subscribe = new Subscribe();
        $subscribe->setEmail($request['email']);
        $subscribe->generateToken();
        $subscribe->setDate(now());

        $this->em->persist($subscribe);
        $this->em->flush();

        return $subscribe;
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
        $tag = $this->em->find(self::ENTITY_NAME, $id);
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
        $tag = $this->em->find(self::ENTITY_NAME, $id);
        $this->em->remove($tag);
    }

    // todo метод как в категорирепозитори
    public function getArrayOfIdAndTitle()
    {
        $resultQuery = $this->em->createQuery('select c.id, c.title from App\Entities\Tag c')->getResult();

        $result = [];
        foreach ($resultQuery as $category) {
            $result[$category['id']] = $category['title'];
        }

        return $result;
    }
}

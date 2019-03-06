<?php

namespace App\Repositories;

use App\Entities\Subscribe;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Class SubscribeRepository
 * @package App\Repositories
 *
 * @property EntityManager $em
 */
class SubscribeRepository extends EntityRepository
{
    /** @var EntityManager $em */
    private $em;

    public function __construct(EntityManager $em, $meta)
    {
        parent::__construct($em, $meta);
        $this->em = $em;
    }

    /**
     * Add subscriber
     *
     * @param array $request
     * @return Subscribe
     * @throws \Doctrine\ORM\ORMException
     */
    public function add(array $request)
    {
        /** @var Subscribe $subscribe */
        $subscribe = new Subscribe();
        $subscribe->setEmail($request['email']);
        $subscribe->generateToken();
        $subscribe->setDate(now());

        $this->em->persist($subscribe);

        return $subscribe;
    }

    /**
     *  Delete subscriber
     *
     * @param int $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function delete(int $id)
    {
        $tag = $this->em->find(Subscribe::class, $id);
        $this->em->remove($tag);
    }
}

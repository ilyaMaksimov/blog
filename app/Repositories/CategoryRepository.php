<?php

namespace App\Repositories;

use App\Entities\Category;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Dropbox\Exception;

class CategoryRepository extends EntityRepository
{
    private $entityName = 'App\Entities\Category';

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
        /** @var Category $category */
        $category = new Category();
        $category->setTitle($request['title']);
        $category->setSlug($request['title']);

        $this->em->persist($category);
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
        $category = $this->em->find($this->entityName, $id);
        $category->setTitle($request['title']);
        $category->setSlug($request['title']);

        $this->em->persist($category);
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
        $category = $this->em->find($this->entityName, $id);

        $this->em->remove($category);
        $this->em->flush();
    }


// todo метод как в tegрирепозитори

    /**
     * @return array
     */
    public function getArrayOfIdAndTitle()
    {
        $resultQuery = $this->em->createQuery('select c.id, c.title from App\Entities\Category c')->getResult();

        $result = [];
        foreach ($resultQuery as $category) {
            $result[$category['id']] = $category['title'];
        }

        return $result;
    }
}

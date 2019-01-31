<?php

namespace App\Repositories;

use App\Entities\Category;
use App\Entities\Post;
use App\Entities\Tag;
use App\Components\Image;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Dropbox\Exception;

class PostRepository extends EntityRepository
{
    private $entityName = 'App\Entities\Post';

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

        $post = new Post();
        $post->setTitle($request['title']);
        $post->setSlug($request['title']);

        $category = $this->em->find(Category::class, $request['category']);
        $post->setCategory($category);

        $post->setDescription($request['description']);
        $post->setContent($request['content']);

        $post->setIsPublic($request['is_public']);
        $post->setIsFeatured($request['is_featured']);

        $post->setDate($request['date']);

        $image = new Image();
        $image->save($request['image']);
        $post->setImage($image->getName());

        $tags = $this->em->getRepository('App\Entities\Tag')->findBy(['id' => $request['tags']]);

        foreach ($tags as $tag) {
            $post->addTag($tag);
        }


        $this->em->persist($post);
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
        /** @var Post $post */
        $post = $this->em->find($this->entityName, $id);
        $post->setTitle($request['title']);
        $post->setSlug($request['title']);

        $category = $this->em->find(Category::class, $request['category']);
        $post->setCategory($category);

        $post->setDescription($request['description']);
        $post->setContent($request['content']);

        $post->setIsPublic($request['is_public']);
        $post->setIsFeatured($request['is_featured']);

        $post->setDate($request['date']);

        $image = new Image();
        $image->update($request['image'], $post->getImage());

        $post->setImage($image->getName());

        // Это очень плохое решение?
        $tags = $this->em->getRepository('App\Entities\Tag')->findBy(['id' => $request['tags']]);
        $post->getTags()->clear();
        foreach ($tags as $tag) {
            $post->addTag($tag);
        }


        $this->em->persist($post);
        $this->em->flush();
    }

    /**
     * @param int $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function delete(int $id)
    {
        $post = $this->em->find($this->entityName, $id);

        $image = new Image();
        $image->remove($post->getImage());
        $this->em->remove($post);
        $this->em->flush();
    }
}

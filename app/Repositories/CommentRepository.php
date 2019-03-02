<?php

namespace App\Repositories;

use App\Entities\Post;
use App\Entities\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use App\Entities\Comment;
use Illuminate\Support\Facades\Auth;

class CommentRepository extends EntityRepository
{
    const ENTITY_NAME = 'App\Entities\Comment';

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
        /** @var Comment $tag */
        $comment = new Comment();
        $user = $this->em->find(User::class, Auth::id());
        $comment->setUserId($user);

        $post = $this->em->find(Post::class, $request['post_id']);
        $comment->setPostId($post);
        $comment->setText($request['message']);
        $comment->setStatus(Comment::STATUS_WAITING_VERIFICATION);
        $comment->setDate(now());

        $this->em->persist($comment);
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
        $this->em->flush();
    }
}

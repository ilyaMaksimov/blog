<?php

namespace App\Repositories;

use App\Entities\Post;
use App\Entities\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use App\Entities\Comment;
use Illuminate\Support\Facades\Auth;

/**
 * Class CommentRepository
 * @package App\Repositories
 *
 * @property EntityManager $em
 */
class CommentRepository extends EntityRepository
{
    /** @var EntityManager $em */
    private $em;

    public function __construct(EntityManager $em, $meta)
    {
        parent::__construct($em, $meta);
        $this->em = $em;
    }

    /**
     * Add comment
     *
     * @param array $request
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function add(array $request)
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
    }

    /**
     * Delete comment
     *
     * @param int $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function delete(int $id)
    {
        $comment = $this->em->find(Comment::class, $id);
        $this->em->remove($comment);
    }

    /**
     * Change comment status
     *
     * @param int $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function toggleStatus(int $id)
    {
        $comment = $this->em->find(Comment::class, $id);
        $comment->toggleStatus();

        $this->em->persist($comment);
    }

    /**
     * Find comments by status
     *
     * @param bool $status
     * @return mixed
     */
    public function findByStatus(bool $status)
    {
        $query = "SELECT c FROM App\Entities\Comment c WHERE c.status = :status";
        return $query = $this->em->createQuery($query)
            ->setParameter(':status', $status)
            ->getResult();
    }
}

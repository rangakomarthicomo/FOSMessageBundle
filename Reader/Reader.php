<?php

namespace Ornicar\MessageBundle\Reader;

use Ornicar\MessageBundle\Authorizer\AuthorizerInterface;
use Ornicar\MessageBundle\Model\ReadableInterface;
use Ornicar\MessageBundle\ModelManager\ReadableManagerInterface;

class Reader implements ReaderInterface
{
    /**
     * The authorizer instance
     *
     * @var AuthorizerInterface
     */
    protected $authorizer;

    /**
     * The readable manager
     *
     * @var ReadableManagerInterface
     */
    protected $readableManager;

    public function __construct(AuthorizerInterface $authorizer, ReadableManagerInterface $readableManager)
    {
        $this->authorizer = $authorizer;
        $this->readableManager = $readableManager;
    }

    /**
     * Marks the readable as read by the current authenticated user
     *
     * @param ReadableInterface $readable
     */
    public function markAsRead(ReadableInterface $readable)
    {
        $this->readableManager->markAsReadByParticipant($readable, $this->getAuthenticatedUser());
    }

    /**
     * Marks the readable as unread by the current authenticated user
     *
     * @param ReadableInterface $readable
     */
    public function markAsUnread(ReadableInterface $readable)
    {
        $this->readableManager->markAsReadByParticipant($readable, $this->getAuthenticatedUser());
    }

    /**
     * Gets the current authenticated user
     *
     * @return UserInterface
     */
    protected function getAuthenticatedUser()
    {
        return $this->authorizer->getAuthenticatedUser();
    }
}
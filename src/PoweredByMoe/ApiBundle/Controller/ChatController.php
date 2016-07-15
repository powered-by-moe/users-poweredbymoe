<?php

namespace PoweredByMoe\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ChatController extends FOSRestController
{
    /**
     * Index action
     *
     * Returns conversations for authenticated user
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $repository = $this->get('fos_message.repository');
        $view = $this->view(
            $repository->getPersonConversations($this->getUser())
        );
        
        return $this->handleView($view);
    }

    /**
     * Conversation action
     *
     * Returns conversation and messages for given conversation
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function conversationAction($id)
    {
        $repository = $this->get('fos_message.repository');
        $conversation = $repository->getConversation($id);

        if(!$conversation->isPersonInConversation($this->getUser())) {
            throw new AccessDeniedHttpException();
        }

        $messages = $repository->getMessages($conversation);

        $view = $this->view([
            'conversation' => $conversation,
            'messages' => $messages
        ]);

        return $this->handleView($view);
    }

    /**
     * New Conversation action
     *
     * Start new conversation between authenticated user (sender) and given userId (receiver)
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newConversationAction(Request $request)
    {
        $sender = $this->get('fos_message.sender');
        if ($request->getMethod() == 'POST') {
            $conversation = $sender->startConversation($this->getUser(), $this->getUser(), 'test');

            return $this->handleView(
                $this->view([
                    'success' => true,
                    'conversation' => $conversation
                ])
            );
        } else {
            throw new HttpException();
        }
    }
}

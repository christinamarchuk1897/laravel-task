<?php

namespace App\Repositories\Message;

use App\Repositories\BaseRepository;
use App\Models\Message;
use App\Models\User;


class MessageRepository extends BaseRepository {

    protected $model;

    public function __construct(Message $message)
    {
        $this->model = $message;
    }

    public function get(User $user, int $contact_id)
    {
        $messages = $this->getMessages($contact_id)->get()->map(function($elem) {
            $elem['user'] = $elem->user;
            return $elem;
        });;
        return [
            'data' => [
                'messages' => $messages,
                'count' => $messages->count()
            ]
        ];
    }

    private function getMessages(int $contact_id)
    {
        return $this->model
                ->where([['user_id', auth()->id()], ['contact_id', $contact_id]])
                ->orWhere([['user_id', $contact_id],['contact_id', auth()->id()]])
                ->orderBy('id', 'asc');
    }

    public function fetchLatest(int $id)
    {
        $messages = $this->model->where([['contact_id', $id], ['read', false]])->get()->groupBy('user_id')->map(function($elem) {
            return $elem->map(function($e) {
                $e['user'] = $e->user;
                return $e;
            });
        });

        return $messages;
    }

    public function read($id){
        $this->setRead($id);
    }

    private function setRead($contact_id){
        $this->model->where('user_id', $contact_id)->where('contact_id', auth()->id())->update(['read' => true]);
    }
}
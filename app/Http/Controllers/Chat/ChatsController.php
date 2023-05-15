<?php

namespace App\Http\Controllers\Chat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Http\Requests\ChatRequest;
use App\Events\MessageSent;
use App\Repositories\Message\MessageRepository;

class ChatsController extends Controller
{

    protected $messageRepository;

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MessageRepository $messageRepository)
    {
        $this->middleware('auth');
        $this->messageRepository = $messageRepository;
    }

    /**
     * Fetch message.
     *
     * @return JsonResource
     */
    public function fetchMessages(int $contact_id)
    {
        try {
            $this->messageRepository->read($contact_id);
            return $this->messageRepository->get(auth()->user(), $contact_id);
        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()]);
        }
    }

    /**
     * Send message
     *
     * @return json
     */
    public function sendMessage(int $contact_id, ChatRequest $request)
    {
        try {
            $user = auth()->user();
            $message = $user->messages()->create([
                'user_id' => $user->id,
                'contact_id' => $contact_id,
                'message' => $request->input('message')
            ]);

            broadcast(new MessageSent($message));
            return ['status' => 'Message Sent!'];
        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()]);
        }
    }

    /**
     * Fetch latest messages
     *
     * @return json
     */
    public function fetchLatestMessage(?int $user_id)
    {
        try {
            return $this->messageRepository->fetchLatest($user_id);
        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()]);
        }
    }
}

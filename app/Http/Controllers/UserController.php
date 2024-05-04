<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Message;

class UserController extends Controller
{
//    private function lastMessage(?User $users) : array {
//        $authenticatedUser = auth()->user();
//        $otherUsers = User::select('id', 'name', 'image', 'status')
//            ->where('id', '!=', $authenticatedUser->getAuthIdentifier())
//            ->get()
//            ->toArray();
//
//        $lastMsgUser = [];
//
//        if($users) {
//            $otherUsers = $users;
//        }
//        foreach ($otherUsers as $user) {
//            $lastMessage = Message::selectRaw('msg')
//                ->where(function ($query) use ($user, $authenticatedUser) {
//                    $query->where('sender_id', $authenticatedUser->getAuthIdentifier())
//                        ->where('receiver_id', $user['id']);
//                })->orWhere(function ($query) use ($user, $authenticatedUser) {
//                    $query->where('sender_id', $user['id'])
//                        ->where('receiver_id', $authenticatedUser->getAuthIdentifier());
//                })->orderBy('sent_at', 'DESC')->value('msg');
//
//
//            $mergedUser = array_merge($user, ['last_message' => $lastMessage]);
//            $lastMsgUser[] = $mergedUser;
//        }
//
//
//        return $lastMsgUser;
//    }

    private function lastMessage($users = null): array {
        $authenticatedUser = auth()->user();
        $query = User::select('id', 'name', 'image', 'status')
            ->where('id', '!=', $authenticatedUser->getAuthIdentifier())
            ->orderBy("id", "DESC");

        if (is_array($users) && count($users) > 0) {
            $userIds = array_column($users, 'id');
            $query->whereIn('id', $userIds);
        }

        $otherUsers = $query->get()->toArray();
        $lastMsgUser = [];

        foreach ($otherUsers as $user) {
            $lastMessage = Message::select('msg')
                ->where(function ($query) use ($user, $authenticatedUser) {
                    $query->where('sender_id', $authenticatedUser->getAuthIdentifier())
                        ->where('receiver_id', $user['id']);
                })
                ->orWhere(function ($query) use ($user, $authenticatedUser) {
                    $query->where('sender_id', $user['id'])
                        ->where('receiver_id', $authenticatedUser->getAuthIdentifier());
                })
                ->orderBy('sent_at', 'DESC')
                ->value('msg');

            $mergedUser = array_merge($user, ['last_message' => $lastMessage]);
            $lastMsgUser[] = $mergedUser;
        }

        return $lastMsgUser;
    }


    public function showUserHeader()
    {
        $user = Auth::user();
        return view("users.index", ["user" => $user]);
    }


    public function index() {
        $lastMsgUser = $this->lastMessage();
        return view('users.users-list', ['lastMsgUser' => $lastMsgUser]);
    }

    public function search(Request $request)
    {
        $searchTerm = $request->query("searchTerm");
        $searchResults = User::where('id', '!=', auth()->user()->getAuthIdentifier())
            ->where('name', 'LIKE', "%{$searchTerm}%")->get()->toArray();
        $searchRes_W_lm = $this->lastMessage($searchResults);

        return view('users.search', ['searchResults' => $searchRes_W_lm]);
    }

}

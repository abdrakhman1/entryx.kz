<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiTicketController extends Controller
{
    public function tickets()
    {
        $tickets = Ticket::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(20);
        return $this->sendResponse($tickets);
    }

    public function create(Request $request)
    {
        $validate= Validator::make(
            $request->all(),
            [
                'subject' => 'required|min:5',
                'message' => 'required|min:10',
            ]
        );

        if ($validate->fails()) {
            return $this->sendError($validate->errors());
        }

        $ticket = Ticket::create([
            'user_id' => $request->user()->id,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'open',
        ]);

        return $this->sendResponse($ticket);
    }

    public function show(Ticket $ticket)
    {
        $ticket->replies;
        return $this->sendResponse($ticket);
    }

    public function reply(Ticket $ticket, Request $request)
    {
        $validate= Validator::make(
            $request->all(),
            [
                'message' => 'required',
            ]
        );

        if ($validate->fails()) {
            return $this->sendError($validate->errors());
        }

        $ticket_reply = TicketReply::create([
            'ticket_id' => $ticket->id,
            'user_id' => auth()->user()->id,
            'message' => $request->message,
        ]);
        
        return $this->sendResponse($ticket_reply);
    }

    public function set_close(Ticket $ticket)
    {
        if ($ticket->user->id == auth()->user()->id) {
            $ticket->status = 'closed';
            $ticket->save();
        }
        $ticket->replies;
        return $this->sendResponse($ticket);
    }

    public function set_open(Ticket $ticket)
    {
        if ($ticket->user->id == auth()->user()->id) {
            $ticket->status = 'open';
            $ticket->save();
        }
        $ticket->replies;
        return $this->sendResponse($ticket);
    }
    
}

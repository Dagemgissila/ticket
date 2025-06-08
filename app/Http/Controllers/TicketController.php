<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketStatus;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\TicketAssignedMail;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = Ticket::with(['user', 'assignedTo', 'TicketComments.user']);

        if ($user->role !== 'admin') {
            $query->where('user_id', $user->id);
        }
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        if ($request->has('priority')) {
            $query->where('priority', $request->priority);
        }

        $tickets = $query->get();

        return TicketResource::collection($tickets);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        $ticket = Ticket::create($data);

        return new TicketResource($ticket);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketStatus $request, Ticket $ticket)
    {
        $this->authorize("update", $ticket);
        $data = $request->validated();
        $ticket->update($data);

        return new TicketResource($ticket);

    }

    public function assignTo(Request $request)
    {

        $request->validate([
            "user_id" => "required|exists:users,id",
            "ticket_id" => "required|exists:tickets,id"
        ]);

        $ticket = Ticket::findOrFail($request->ticket_id);

        // only admin can assign ticket
        $this->authorize("assign", $ticket);
        $user = User::findOrFail($request->user_id);

        if ($user->role !== 'admin') {
            return response([
                "message" => "You can only assign tickets to an admin."
            ], 403);
        }

        $ticket->assigned_to = $user->id;
        $ticket->save();


        Mail::to($user->email)->send(new TicketAssignedMail($ticket));

        return response([
            "message" => "Ticket successfully assigned.",
            "ticket" => $ticket
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}

<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TicketPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }


    public function update(User $user, Ticket $ticket)
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, Ticket $ticket)
    {
        return $user->role === 'admin';
    }

    public function assign(User $user)
    {
        return $user->role === 'admin';
    }

    public function comment(User $user, Ticket $ticket): bool
    {
        return $user->role === 'admin' || $user->id === $ticket->user_id;
    }


}

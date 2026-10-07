<?php

namespace App\Http\Controllers;

use App\Models\Tabungan;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CollaborationController extends Controller
{
    public function show(Tabungan $tabungan): View
    {
        abort_unless($tabungan->user_id === auth()->id() || $tabungan->collaborators()->whereKey(auth()->id())->exists(), 403);
        return view('tabungan.show', ['tabungan' => $tabungan->load(['user', 'collaborators', 'menabung' => fn ($q) => $q->latest()])]);
    }

    public function remove(Tabungan $tabungan, User $user): RedirectResponse
    {
        abort_unless($tabungan->user_id === auth()->id(), 403);
        $tabungan->collaborators()->detach($user->id);
        return back()->with('success', 'Kolaborator dihapus.');
    }
}

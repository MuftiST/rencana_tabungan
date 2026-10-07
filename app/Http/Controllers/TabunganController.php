<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTabunganRequest;
use App\Models\Tabungan;
use App\Models\LogAktivitas;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TabunganController extends Controller
{
    public function index(): View
    {
        $recentDeposits = fn ($query) => $query->where('tanggal', '>=', now()->subDays(29)->toDateString())->orderBy('tanggal');
        $owned = auth()->user()->tabungan()->withSum('menabung', 'nominal')->with(['menabung' => $recentDeposits])->latest()->get();
        $shared = auth()->user()->sharedTabungan()->withSum('menabung', 'nominal')->with(['menabung' => $recentDeposits])->latest()->get();
        $tabungan = $owned->concat($shared)->unique('id')->values();
        $tabungan->each(function (Tabungan $goal): void {
            $goal->setAttribute('sparkline', $goal->menabung->groupBy(fn ($deposit) => $deposit->tanggal->toDateString())->map->sum('nominal')->values()->all());
            $daysTotal = max(1, now()->diffInDays($goal->created_at));
            $daysElapsed = max(1, min($daysTotal, $goal->created_at->diffInDays(now())));
            $expectedProgress = min(100, ($daysElapsed / max(1, $goal->created_at->diffInDays($goal->target_tanggal))) * 100);
            $goal->setAttribute('pace_status', $goal->status === 'tercapai' ? 'tercapai' : ($goal->persentase_progress >= $expectedProgress ? 'on-track' : 'tertinggal'));
        });
        return view('home', compact('tabungan'));
    }

    public function create(): View { return view('tabungan.create'); }

    public function store(StoreTabunganRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if ($request->hasFile('foto')) $data['foto'] = $request->file('foto')->store('tabungan', 'public');
        $tabungan = auth()->user()->tabungan()->create($data);
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'tabungan_id' => $tabungan->id,
            'aktivitas' => 'tabungan baru',
            'deskripsi' => 'Membuat tabungan baru: '.$tabungan->judul,
        ]);
        return redirect()->route('home')->with('success', 'Tabungan berhasil dibuat.');
    }

    public function edit(Tabungan $tabungan): View
    {
        $this->authorizeOwnership($tabungan);
        return view('tabungan.edit', compact('tabungan'));
    }

    public function update(StoreTabunganRequest $request, Tabungan $tabungan): RedirectResponse
    {
        $this->authorizeOwnership($tabungan);
        $data = $request->validated();
        if ($request->hasFile('foto')) {
            if ($tabungan->foto) Storage::disk('public')->delete($tabungan->foto);
            $data['foto'] = $request->file('foto')->store('tabungan', 'public');
        }
        $tabungan->update($data);
        $tabungan->loadSum('menabung', 'nominal');
        $tabungan->updateQuietly([
            'status' => (float) $tabungan->menabung_sum_nominal >= (float) $tabungan->target_nominal
                ? 'tercapai' : 'belum_tercapai',
        ]);
        return redirect()->route('home')->with('success', 'Tabungan berhasil diperbarui.');
    }

    public function destroy(Tabungan $tabungan): RedirectResponse
    {
        $this->authorizeOwnership($tabungan);
        if ($tabungan->foto) Storage::disk('public')->delete($tabungan->foto);
        $tabungan->delete();
        return redirect()->route('home')->with('success', 'Tabungan berhasil dihapus.');
    }

    private function authorizeOwnership(Tabungan $tabungan): void
    {
        abort_unless($tabungan->user_id === auth()->id(), 403);
    }
}

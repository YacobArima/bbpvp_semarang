<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JurusanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $totalAlumni = \App\Models\Alumni::count();
    return view('welcome', compact('totalAlumni'));
})->name('home');



Route::get('/dashboard', function () {
    // Only admin can access dashboard
    if (auth()->user()->role !== 'admin') {
        return redirect()->route('alumni.public');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/alumni', function (\Illuminate\Http\Request $request) {
        $search = $request->query('search');
        $jurusanId = $request->query('jurusan_id');
        $pelatihanId = $request->query('pelatihan_id');
        $user = auth()->user();

        $alumniQuery = \App\Models\Alumni::with('user', 'jurusan', 'pelatihan');
        $selectedJurusan = null;
        $activePelatihan = null;

        $isAdmin = $user->role === 'admin';
        $hasProfile = $user->alumni !== null;

        // Apply class-based filter for non-admin users
        if (!$isAdmin) {
            $myAlumniRecord = $user->alumni;
            if ($myAlumniRecord) {
                // Only show alumni from the same pelatihan
                $alumniQuery->where('pelatihan_id', $myAlumniRecord->pelatihan_id);
                // Bypass department grid to show their class immediately
                $selectedJurusan = $myAlumniRecord->jurusan;
                $activePelatihan = $myAlumniRecord->pelatihan;
            } else {
                // If user hasn't filled their profile, show nothing
                $alumniQuery->where('id', 0);
                // Force into the list view to show the empty state message
                $selectedJurusan = (object) ['name' => 'Data Alumni'];
            }
        } else {
            // Admin flow: handle 'all' or specific jurusan
            if ($jurusanId === 'all') {
                $selectedJurusan = (object) ['name' => 'Semua Alumni', 'id' => 'all'];
            } else {
                $selectedJurusan = $jurusanId ? \App\Models\Jurusan::find($jurusanId) : null;
            }

            // Allow admin to filter by pelatihan_id
            if ($pelatihanId) {
                $alumniQuery->where('pelatihan_id', $pelatihanId);
                $activePelatihan = \App\Models\Pelatihan::find($pelatihanId);
            }
        }

        $jurusans = \App\Models\Jurusan::withCount('alumni')->get();
        $pelatihans = [];

        if ($isAdmin) {
            // Get pelatihans for filtering
            if ($selectedJurusan && isset($selectedJurusan->id) && $selectedJurusan->id !== 'all') {
                $pelatihans = \App\Models\Pelatihan::where('jurusan_id', $selectedJurusan->id)->get();
            } else {
                $pelatihans = \App\Models\Pelatihan::all();
            }
        }

        $alumni = $alumniQuery
            ->when($isAdmin && $jurusanId && $jurusanId !== 'all', function ($query) use ($jurusanId) {
                $query->where('jurusan_id', $jurusanId);
            })
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('user', function ($inner) use ($search) {
                        $inner->where('name', 'like', "%{$search}%");
                    })
                        ->orWhere('graduation_year', 'like', "%{$search}%")
                        ->orWhereHas('jurusan', function ($inner) use ($search) {
                            $inner->where('name', 'like', "%{$search}%");
                        })
                        ->orWhereHas('pelatihan', function ($inner) use ($search) {
                            $inner->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('alumni.public', compact('alumni', 'jurusans', 'pelatihans', 'selectedJurusan', 'activePelatihan', 'hasProfile', 'isAdmin'));
    })->name('alumni.public');
    Route::resource('alumni-profile', \App\Http\Controllers\AlumniController::class)->parameters([
        'alumni-profile' => 'alumnus'
    ])->except(['show', 'destroy', 'index'])->names([
                'create' => 'alumni.create',
                'store' => 'alumni.store',
                'edit' => 'alumni.edit',
                'update' => 'alumni.update',
            ]);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('jurusans', JurusanController::class)->except(['show']);
        Route::resource('alumni', \App\Http\Controllers\Admin\AlumniController::class)->except(['show']);
    });
});

require __DIR__ . '/auth.php';

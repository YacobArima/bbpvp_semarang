<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $alumni = Alumni::with('user', 'jurusan', 'pelatihan')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('user', function ($inner) use ($search) {
                        $inner->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    })
                        ->orWhere('graduation_year', 'like', "%{$search}%")
                        ->orWhereHas('jurusan', function ($inner) use ($search) {
                            $inner->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.alumni.index', compact('alumni'));
    }

    public function edit(Alumni $alumnus)
    {
        $jurusans = \App\Models\Jurusan::all();
        $pelatihans = \App\Models\Pelatihan::where('jurusan_id', $alumnus->jurusan_id)->get();
        return view('admin.alumni.edit', compact('alumnus', 'jurusans', 'pelatihans'));
    }

    public function update(Request $request, Alumni $alumnus)
    {
        // Validation logic similar to public controller but with admin overrides if needed
        $request->validate([
            'graduation_year' => 'required|digits:4',
            'employment_status' => 'required|in:bekerja,belum_bekerja',
            // ... add other necessary validations
        ]);

        $alumnus->update($request->all());

        return redirect()->route('admin.alumni.index')->with('success', 'Alumni updated successfully.');
    }

    public function destroy(Alumni $alumnus)
    {
        // Delete photo if exists
        if ($alumnus->photo_path) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($alumnus->photo_path);
        }

        $alumnus->delete();
        return redirect()->route('admin.alumni.index')->with('success', 'Alumni deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $jurusans = Jurusan::with(['pelatihans'])
            ->withCount('alumni')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhereHas('pelatihans', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.jurusans.index', compact('jurusans'));
    }

    public function create()
    {
        return view('admin.jurusans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:jurusans,name',
        ]);

        Jurusan::create($request->all());

        return redirect()->route('admin.jurusans.index')->with('success', 'Jurusan created successfully.');
    }

    public function edit(Jurusan $jurusan)
    {
        return view('admin.jurusans.edit', compact('jurusan'));
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:jurusans,name,' . $jurusan->id,
        ]);

        $jurusan->update($request->all());

        return redirect()->route('admin.jurusans.index')->with('success', 'Jurusan updated successfully.');
    }

    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();
        return redirect()->route('admin.jurusans.index')->with('success', 'Jurusan deleted successfully.');
    }
}

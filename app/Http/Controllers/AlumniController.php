<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\Alumni;
use Illuminate\Support\Facades\Storage;

class AlumniController extends Controller
{
    public function create()
    {
        $jurusans = Jurusan::with('pelatihans')->get();
        // Check if user already has an alumni profile, if so redirect to edit
        if (auth()->user()->alumni) {
            return redirect()->route('alumni.edit', auth()->user()->alumni);
        }
        return view('alumni.create', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jurusan_id' => 'required|exists:jurusans,id',
            'pelatihan_id' => 'required|exists:pelatihans,id',
            'graduation_year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'employment_status' => 'required|in:bekerja,belum_bekerja',
            'address' => 'required|string',
            'phone_number' => 'required|string|max:20',
            'company_name' => 'required_if:employment_status,bekerja|nullable|string|max:255',
            'position' => 'required_if:employment_status,bekerja|nullable|string|max:255',
            'description' => 'nullable|string',
            'cropped_image' => 'required|string|max:300000', // Base64 cropped image (approx 225KB)
        ]);

        // Process base64 image
        $imageData = $request->cropped_image;
        if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)) {
            $imageData = substr($imageData, strpos($imageData, ',') + 1);
            $type = strtolower($type[1]); // jpg, png, gif

            if (!in_array($type, ['jpg', 'jpeg', 'png'])) {
                return back()->withErrors(['cropped_image' => 'Invalid image type.']);
            }

            $imageData = base64_decode($imageData);

            if ($imageData === false) {
                return back()->withErrors(['cropped_image' => 'Image decode failed.']);
            }
        } else {
            return back()->withErrors(['cropped_image' => 'Invalid image format.']);
        }

        $fileName = 'alumni-photos/' . uniqid() . '.' . $type;
        Storage::disk('public')->put($fileName, $imageData);

        auth()->user()->alumni()->create([
            'jurusan_id' => $request->jurusan_id,
            'pelatihan_id' => $request->pelatihan_id,
            'graduation_year' => $request->graduation_year,
            'employment_status' => $request->employment_status,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'company_name' => $request->company_name,
            'position' => $request->position,
            'description' => $request->description,
            'photo_path' => $fileName,
        ]);

        return redirect()->route('alumni.public')->with('success', 'Profile completed successfully.');
    }

    public function edit(Alumni $alumnus)
    {
        // Ensure user owns the profile or is admin (if needed)
        if ($alumnus->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403);
        }

        $jurusans = Jurusan::with('pelatihans')->get();
        return view('alumni.edit', compact('alumnus', 'jurusans'));
    }

    public function update(Request $request, Alumni $alumnus)
    {
        if ($alumnus->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'jurusan_id' => 'required|exists:jurusans,id',
            'pelatihan_id' => 'required|exists:pelatihans,id',
            'graduation_year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'employment_status' => 'required|in:bekerja,belum_bekerja',
            'address' => 'required|string',
            'phone_number' => 'required|string|max:20',
            'company_name' => 'required_if:employment_status,bekerja|nullable|string|max:255',
            'position' => 'required_if:employment_status,bekerja|nullable|string|max:255',
            'description' => 'nullable|string',
            'cropped_image' => 'nullable|string|max:300000', // Optional for update
        ]);

        $data = [
            'jurusan_id' => $request->jurusan_id,
            'pelatihan_id' => $request->pelatihan_id,
            'graduation_year' => $request->graduation_year,
            'employment_status' => $request->employment_status,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'company_name' => $request->employment_status === 'bekerja' ? $request->company_name : null,
            'position' => $request->employment_status === 'bekerja' ? $request->position : null,
            'description' => $request->description,
        ];

        if ($request->filled('cropped_image')) {
            // Process base64 image
            $imageData = $request->cropped_image;
            if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)) {
                $imageData = substr($imageData, strpos($imageData, ',') + 1);
                $type = strtolower($type[1]);
                $imageData = base64_decode($imageData);

                if ($imageData) {
                    // Delete old photo
                    if ($alumnus->photo_path) {
                        Storage::disk('public')->delete($alumnus->photo_path);
                    }

                    $fileName = 'alumni-photos/' . uniqid() . '.' . $type;
                    Storage::disk('public')->put($fileName, $imageData);
                    $data['photo_path'] = $fileName;
                }
            }
        }

        $alumnus->update($data);

        return redirect()->route('alumni.public')->with('success', 'Profile updated successfully.');
    }
}

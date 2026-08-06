<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pasien;
use App\Models\Obat;
use App\Models\Tarif;
use App\Models\Kunjungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // =====================================================================
    // DASHBOARD
    // =====================================================================

    public function index()
    {
        $totalPasien      = Pasien::count();
        $totalUser        = User::count();
        $totalObat        = Obat::count();
        $kunjunganHariIni = Kunjungan::whereDate('tanggal_kunjungan', today())->count();

        return view('admin.index', compact(
            'totalPasien',
            'totalUser',
            'totalObat',
            'kunjunganHariIni'
        ));
    }

    // =====================================================================
    // MANAJEMEN USER
    // =====================================================================

    public function userIndex()
    {
        $users = User::latest()->get();
        return view('admin.user.index', compact('users'));
    }

    public function userCreate()
    {
        return view('admin.user.create');
    }

    public function userStore(Request $request)
    {
        $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|min:6|confirmed',
            'role'                  => 'required|in:admin,pendaftaran,pemeriksaan,pembayaran,farmasi',
        ]);

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => $request->role,
            'is_active' => true,
        ]);

        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function userEdit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function userUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $id,
            'role'     => 'required|in:admin,pendaftaran,pemeriksaan,pembayaran,farmasi',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.user.index')
            ->with('success', 'Data user berhasil diperbarui.');
    }

    public function userDestroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil dihapus.');
    }

    public function userToggle($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = !$user->is_active;
        $user->save();

        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->route('admin.user.index')
            ->with('success', "User berhasil {$status}.");
    }

    // =====================================================================
    // DATA PASIEN
    // =====================================================================

    public function pasienIndex(Request $request)
    {
        $search = $request->search;

        $pasiens = Pasien::when($search, function ($q) use ($search) {
            $q->where('nik_pasien', 'like', "%{$search}%")
              ->orWhere('nama_pasien', 'like', "%{$search}%");
        })->latest()->get();

        return view('admin.pasien.index', compact('pasiens', 'search'));
    }

    public function pasienShow($id)
    {
        $pasien = Pasien::findOrFail($id);
        return view('admin.pasien.show', compact('pasien'));
    }

    public function pasienEdit($id)
    {
        $pasien = Pasien::findOrFail($id);
        return view('admin.pasien.edit', compact('pasien'));
    }

    public function pasienUpdate(Request $request, $id)
    {
        $request->validate([
            'nik_pasien'    => 'required',
            'nama_pasien'   => 'required',
            'nama_kk'       => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'alamat_pasien' => 'required',
            'no_hp'         => 'required',
            'id_bpjs'       => 'nullable',
        ]);

        $pasien = Pasien::findOrFail($id);
        $pasien->update($request->only([
            'nik_pasien', 'nama_pasien', 'nama_kk',
            'jenis_kelamin', 'tanggal_lahir', 'alamat_pasien',
            'no_hp', 'id_bpjs',
        ]));

        return redirect()->route('admin.pasien.index')
            ->with('success', 'Data pasien berhasil diperbarui.');
    }

    public function pasienDestroy($id)
    {
        Pasien::findOrFail($id)->delete();
        return redirect()->route('admin.pasien.index')
            ->with('success', 'Data pasien berhasil dihapus.');
    }

    // =====================================================================
    // DATA OBAT
    // =====================================================================

    public function obatIndex(Request $request)
    {
        $search = $request->search;

        $obats = Obat::when($search, function ($q) use ($search) {
            $q->where('nama_obat', 'like', "%{$search}%")
              ->orWhere('kategori_obat', 'like', "%{$search}%");
        })->latest()->get();

        return view('admin.obat.index', compact('obats', 'search'));
    }

    public function obatCreate()
    {
        return view('admin.obat.create');
    }

    public function obatStore(Request $request)
    {
        $request->validate([
            'nama_obat'       => 'required',
            'jenis_obat'      => 'required',
            'kategori_obat'   => 'required',
            'stok_obat'       => 'required|integer|min:0',
            'satuan_obat'     => 'required',
            'stok_minimum'    => 'required|integer|min:0',
            'tanggal_expired' => 'required|date',
        ]);

        Obat::create($request->only([
            'nama_obat', 'jenis_obat', 'kategori_obat',
            'stok_obat', 'satuan_obat', 'stok_minimum', 'tanggal_expired',
        ]));

        return redirect()->route('admin.obat.index')
            ->with('success', 'Data obat berhasil ditambahkan.');
    }

    public function obatEdit($id)
    {
        $obat = Obat::findOrFail($id);
        return view('admin.obat.edit', compact('obat'));
    }

    public function obatUpdate(Request $request, $id)
    {
        $request->validate([
            'nama_obat'       => 'required',
            'jenis_obat'      => 'required',
            'kategori_obat'   => 'required',
            'stok_obat'       => 'required|integer|min:0',
            'satuan_obat'     => 'required',
            'stok_minimum'    => 'required|integer|min:0',
            'tanggal_expired' => 'required|date',
        ]);

        $obat = Obat::findOrFail($id);
        $obat->update($request->only([
            'nama_obat', 'jenis_obat', 'kategori_obat',
            'stok_obat', 'satuan_obat', 'stok_minimum', 'tanggal_expired',
        ]));

        return redirect()->route('admin.obat.index')
            ->with('success', 'Data obat berhasil diperbarui.');
    }

    public function obatDestroy($id)
    {
        Obat::findOrFail($id)->delete();
        return redirect()->route('admin.obat.index')
            ->with('success', 'Data obat berhasil dihapus.');
    }

    // =====================================================================
    // DATA TARIF
    // =====================================================================

    public function tarifIndex(Request $request)
    {
        $search = $request->search;

        $tarifs = Tarif::when($search, function ($q) use ($search) {
            $q->where('nama_tarif', 'like', "%{$search}%")
              ->orWhere('kategori_tarif', 'like', "%{$search}%");
        })->latest()->get();

        return view('admin.tarif.index', compact('tarifs', 'search'));
    }

    public function tarifCreate()
    {
        return view('admin.tarif.create');
    }

    public function tarifStore(Request $request)
    {
        $request->validate([
            'nama_tarif'     => 'required',
            'kategori_tarif' => 'required',
            'biaya_tarif'    => 'required|numeric|min:0',
            'status_tarif'   => 'required|in:Aktif,Nonaktif',
            'kategori_tarif' => 'required|in:Pemeriksaan,Tindakan,Surat',
        ]);

        $kode = 'TRF' . str_pad(Tarif::count() + 1, 3, '0', STR_PAD_LEFT);

        Tarif::create([
            'kode_tarif'     => $kode,
            'nama_tarif'     => $request->nama_tarif,
            'kategori_tarif' => $request->kategori_tarif,
            'biaya_tarif'    => $request->biaya_tarif,
            'status_tarif'   => $request->status_tarif,
        ]);

        return redirect()->route('admin.tarif.index')
            ->with('success', 'Data tarif berhasil ditambahkan.');
    }

    public function tarifEdit($id)
    {
        $tarif = Tarif::findOrFail($id);
        return view('admin.tarif.edit', compact('tarif'));
    }

    public function tarifUpdate(Request $request, $id)
    {
        $request->validate([
            'nama_tarif'     => 'required',
            'kategori_tarif' => 'required',
            'biaya_tarif'    => 'required|numeric|min:0',
            'status_tarif'   => 'required|in:Aktif,Nonaktif',
            'kategori_tarif' => 'required|in:Pemeriksaan,Tindakan,Surat',
        ]);

        $tarif = Tarif::findOrFail($id);
        $tarif->update($request->only([
            'nama_tarif', 'kategori_tarif', 'biaya_tarif', 'status_tarif',
        ]));

        return redirect()->route('admin.tarif.index')
            ->with('success', 'Data tarif berhasil diperbarui.');
    }

    public function tarifDestroy($id)
    {
        Tarif::findOrFail($id)->delete();
        return redirect()->route('admin.tarif.index')
            ->with('success', 'Data tarif berhasil dihapus.');
    }
}

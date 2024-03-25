<x-admin-layout>
    <div class="w-full mt-12">
        <p class="text-xl pb-3 flex items-center">
            <i class="fas fa-list mr-3"></i> Penilaian Kinerja Pegawai
        </p>
        <div class="col-md-6">
            <div class="form-group">
                <label for="date_filter">Periode Penilaian:</label>

                <form method="get" action="{{ route('penilaian_kinerja.index') }}">
                    <div class="input-group">
                        <select class="form-select" name="date_filter">
                            <option value="">All Data</option>
                            {{-- Menambahkan opsi untuk setiap periode --}}
                            @foreach($periode as $periode)
                                <option value="{{ $periode->nama_periode }}" {{ $dateFilter == $periode->nama_periode ? 'selected' : '' }}>
                                    {{ $periode->nama_periode }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary">Ganti</button>
                    </div>
                </form>

            </div>
        </div>
        <div class="bg-white overflow-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">No</th> 
                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Nama</th> 
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Jabatan</th>  
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm"></th>
                    </tr>
                </thead>
                
                <tbody class="text-gray-700">
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($pegawai as $pk)
                        <tr>
                            <td class="text-left py-3 px-4">{{ $no++ }}</td>
                            <td class="text-left py-3 px-4">{{ $pk->nama_pegawai }}</td>
                            @php 
                                $position = App\Models\Jabatan::where('id', $pk->jabatan_pegawai)->first()->jabatan;
                            @endphp
                            <td class="text-left py-3 px-4">{{ $position }}</td>
                            <td class="text-left py-3 px-4">
                                <div class="mt-4 mb-4 flex">
                                    @php
                                        $penilaianKinerja = $penilaian_kinerja->where('pegawai', $pk->id)
                                                                            ->where('periode_id', $periodeAktif->id)
                                                                            ->first();
                                        $penilaianKinerjaExists = $penilaianKinerja !== null;
                                        $penilaianKinerjaId = $penilaianKinerjaExists ? $penilaianKinerja->id : null;
                                    @endphp
                                    <div class="mr-2">
                                        <a href="{{ $penilaianKinerjaExists ? route('penilaian_kinerja.edit', ['penilaian_kinerja' => $penilaianKinerjaId, 'periode' => $periodeAktif->id]) : route('penilaian_kinerja.create', ['pegawai' => $pk->id, 'periode' => $periodeAktif->id]) }}" class="bg-green-500 hover:bg-green-700 text-white left-0 font-light py-2 px-4 rounded">
                                            <i class="fas fa-edit"></i> 
                                            {{ $penilaianKinerjaExists ? 'Edit' : 'Buat' }} penilaian
                                        </a>
                                    </div>
                                    
                                    <div>
                                        <a href="{{ $penilaianKinerjaExists ? route('export-pdf', ['id' => $penilaianKinerjaId]): null }}" class="bg-red-500 hover:bg-red-700 text-white left-0 font-light py-2 px-4 rounded">
                                            <i class="far fa-file-pdf"></i> Export PDF
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Periksa apakah ada pesan sukses
        let successMessage = "{{ session('success') }}";

        // Jika ada pesan sukses, tampilkan pesan pop-up
        if (successMessage) {
            alert(successMessage);
        }
    });
</script>
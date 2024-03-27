<x-admin-layout>
    <style>
        /* Gaya untuk label */
        .form-group label {
            font-weight: bold;
            color: #333;
        }
    
        /* Gaya untuk select box */
        .form-select {
            width: 20%;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
    
        /* Gaya untuk tombol Ganti */
        .btn-primary {
            background-color: #2d3748;
            color: #fff;
            border-color: #2d3748;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            border-radius: 0.25rem;
            cursor: pointer;
        }
    
        /* Gaya untuk tombol Ganti saat dihover */
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
    <div class="w-full mt-12">
        <p class="text-2xl pb-3 flex items-center">
            <i class="fas fa-list mr-3"></i> Penilaian Kinerja Pegawai
        </p>
        @if (!empty($periodeEmpty))
            <p>{{ $periodeEmpty }}</p>
        @else
            <div class="col-md-6 mb-5 mt-5">
                <div class="form-group">
                    <label for="date_filter">Periode Penilaian:</label>
                    <form method="get" action="{{ route('penilaian_kinerja.index') }}">
                        <div class="input-group">
                            <select class="form-select" name="date_filter">
                                {{-- Menambahkan opsi untuk setiap periode --}}
                                @foreach($periode as $periodeItem)
                                    <option value="{{ $periodeItem->id }}" {{ $dateFilter == $periodeItem->id ? 'selected': '' }}>
                                        {{ $periodeItem->nama_periode }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary">Ganti</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="bg-white overflow-auto">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">No</th> 
                            <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm text-center">Nama</th> 
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-center">Jabatan</th>  
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-center w-100">Action</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-center w-40">Sudah diisi</th>
                        </tr>
                    </thead>
                    
                    <tbody class="text-gray-700">
                        @php
                            $no = 1;
                        @endphp
                        
            
                        @foreach ($pegawai as $pk)
                            <tr class="border border-gray-300">
                                <td class="text-left px-4">{{ $no++ }}</td>
                                <td class="text-left px-4">{{ $pk->nama_pegawai }}</td>
                                @php 
                                    $position = App\Models\Jabatan::where('id', $pk->jabatan_pegawai)->first()->jabatan;
                                @endphp
                                <td class="text-left px-4">{{ $position }}</td>
                                <td class="text-left px-4">
                                    <div class="mt-4 mb-4 flex justify-center">
                                        @php
                                            $penilaianKinerja = $penilaian_kinerja->where('pegawai', $pk->id)
                                                                                ->where('periode_id', $dateFilter)
                                                                                ->first();
                                            $penilaianKinerjaExists = $penilaianKinerja !== null;
                                            $penilaianKinerjaId = $penilaianKinerjaExists ? $penilaianKinerja->id : null;
                                            $indikator = App\Models\Indikator::where('jabatan_id', $pk->jabatan_pegawai)->get();

                                            // Periksa apakah semua indikator telah diisi
                                            $semuaIndikatorDiisi = true;

                                            if ($penilaianKinerjaExists) {
                                                foreach ($indikator as $ind) {
                                                    $nilaiIndikator = $penilaianKinerja->nilai->where('indikator_id', $ind->id)->first();
                                                    if (!$nilaiIndikator) {
                                                        $semuaIndikatorDiisi = false;
                                                        break;
                                                    }
                                                }
                                            } else {
                                                $semuaIndikatorDiisi = false;
                                            }
                                        @endphp
                                        <div class="mr-2">
                                            <a href="{{ $penilaianKinerjaExists ? route('penilaian_kinerja.edit', ['penilaian_kinerja' => $penilaianKinerjaId, 'periode' => $periodeAktif->id]) : route('penilaian_kinerja.create', ['pegawai' => $pk->id, 'periode' => $periodeAktif->id]) }}" class="bg-green-500 hover:bg-green-700 text-white left-0 font-light py-2 px-4 rounded">
                                                <i class="fas fa-edit"></i> 
                                                {{ $penilaianKinerjaExists ? ' Edit' : 'Buat' }} penilaian
                                            </a>
                                        </div>
                                        <div>
                                            <a href="{{ $penilaianKinerjaExists ? route('export-pdf', ['id' => $penilaianKinerjaId]) : '#' }}" class="bg-red-500 hover:bg-red-700 text-white left-0 font-light py-2 px-4 rounded" onclick="exportPdf(event)">
                                                <i class="far fa-file-pdf"></i> Export PDF
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td>    
                                    <div class="flex justify-center">
                                        @if ($semuaIndikatorDiisi)
                                            <i class="fas fa-check text-green-500 text-lg"></i>
                                        @endif
                                    </div>
                                    
                                </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        @endif
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
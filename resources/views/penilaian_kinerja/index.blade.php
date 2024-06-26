<x-admin-layout>
    <head>
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    </head>
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

        .disabled {
        opacity: 0.5;
        cursor: not-allowed;
        background-color: #B91C1C;
        color: #adb5bd;
    }
    </style>
    <div class="w-full mt-12">
        <p class="text-2xl pb-3 flex items-center">
            <i class="fas fa-list mr-3"></i> Penilaian Kinerja Pegawai
        </p>
        @if (!empty($periodeEmpty))
            <p>{{ $periodeEmpty }}</p>
        @else
            <div class="flex flex-wrap items-center place-content-between mb-5">
                <div class="col-md-6 mb-5 mt-5">
                    <div class="form-group flex items-center">
                        <label for="date_filter">Periode Penilaian:</label>
                        <form method="get" action="{{ route('penilaian_kinerja.index') }}">
                            <div class="input-group ml-3">
                                <select class="form-select" name="date_filter" style="width: auto;"s>
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
                <div>
                    <form method="GET" action="{{ route('penilaian_kinerja.index') }}" class="flex flex-grow">
                        <input type="text" name="search" placeholder="Search" value="{{ request('search') }}" class="p-2 border rounded-l w-full md:w-auto">
                        <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-r flex items-center">
                            <span class="fas fa-search mr-2">
                                search
                            </span> Search
                        </button>
                    </form>
                </div>
            </div>
            <div class="bg-white overflow-auto">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm w-10">No</th> 
                            <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm text-center">Nama</th> 
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-center">Jabatan</th>  
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-center w-100">Action</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-center w-40">Sudah diisi</th>
                        </tr>
                    </thead>
                    
                    <tbody class="text-gray-700">
                        @php
                            $no = ($pegawai->currentPage() - 1) * $pegawai->perPage() + 1;
                        @endphp
                        
            
                        @foreach ($pegawai as $pk)
                            <tr class="border border-gray-300">
                                <td class="text-center px-4">{{ $no++ }}</td>
                                <td class="text-left px-4">{{ $pk->nama_pegawai }}</td>
                                @php 
                                    $position = App\Models\Jabatan::where('id', $pk->jabatan_id)->first()->jabatan;
                                @endphp
                                <td class="text-center px-4">{{ $position }}</td>
                                <td class="text-left px-4">
                                    <div class="mt-4 mb-4 flex justify-center">
                                        @php
                                            $penilaianKinerja = $penilaian_kinerja->where('pegawai', $pk->id)
                                                                                ->where('periode_id', $dateFilter)
                                                                                ->first();
                                            $penilaianKinerjaExists = $penilaianKinerja !== null;
                                            $penilaianKinerjaId = $penilaianKinerjaExists ? $penilaianKinerja->id : null;
                                            $indikator = App\Models\Indikator::where('jabatan_id', $pk->jabatan_id)->get();

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
                                            <a href="{{ $penilaianKinerjaExists ? route('export-pdf', ['id' => $penilaianKinerjaId]) : '#' }}" class="bg-red-500 hover:bg-red-700 text-white left-0 font-light py-2 px-4 rounded{{ $penilaianKinerjaExists ? '' : ' disabled' }}" onclick="{{ $penilaianKinerjaExists ? 'exportPdf(event)' : 'return false;' }}">
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
        <div class="mt-3" >
            {{ $pegawai->links() }}
        </div>
        
    </div>
</x-admin-layout>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Kinerja</title>
    <meta name="firanregina" content="David Grzyb">
    <meta name="description" content="">
    @vite('resources/js/app.js')
    
    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">

    <!-- Preline -->
    <script src="./node_modules/preline/dist/preline.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
        .font-family-karla { font-family: karla; }
        .bg-sidebar { background: #3d68ff; }
        .cta-btn { color: #3d68ff; }
        .upgrade-btn { background: #1947ee; }
        .upgrade-btn:hover { background: #0038fd; }
        .active-nav-link { background: #1947ee; }
        .nav-item:hover { background: #1947ee; }
        .account-link:hover { background: #3d68ff; }
        .data:hover { background: #1947ee; }
    </style>
</head>
<body class="bg-gray-100 font-family-karla flex">
    <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
        <div class="p-6">
            <a href="/home" class="text-white text-2xl font-semibold uppercase hover:text-gray-300">Sistem Penilaian Kinerja</a>
        </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="/home" class="flex items-center {{ Request::is('home') ? 'active-nav-link' : '' }} text-white py-4 pl-6 nav-item opacity-75 hover:opacity-100">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
            <a href="/home/penilaian_kinerja" class="flex items-center {{ Request::is('home/penilaian_kinerja') ? 'active-nav-link' : '' }} text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-file-signature mr-3"></i>
                Penilaian Kinerja
            </a>
            @auth
                @if(Auth::user()->usertype == 'admin')
            <!-- dropdown sidebar -->
            <div x-data="{ isOpen: false}">
                <button @click="isOpen = !isOpen" class="w-full flex items-center text-white font-semibold opacity-75 hover:opacity-100 data py-4 pl-6">
                    <i class="fas fa-table mr-3"></i>
                    <span>Data</span>
                    <i class="fas fa-angle-down ml-2"></i>
                </button>
                <div x-show="isOpen" class="text-white ml-5 focus:outline-none overflow-y-auto h-56">
                    <a href="/home/unit_kerja" class="flex items-center {{ Request::is('home/unit_kerja') ? 'active-nav-link' : '' }} text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                        <i class="fas fa-building mr-3"></i>
                        <p class="text-sm mr-2">1.</p>
                        Unit Kerja
                    </a>
                    <a href="/home/jabatan" class="flex items-center {{ Request::is('home/jabatan') ? 'active-nav-link' : '' }} text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                        <i class="fas fa-sitemap mr-3"></i>
                        <p class="text-sm mr-2">2.</p>
                        Jabatan
                    </a>
                    <a href="/home/pegawai" class="flex items-center {{ Request::is('home/pegawai') ? 'active-nav-link' : '' }} text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                        <i class="far fa-id-card mr-3"></i>
                        <p class="text-sm mr-2">3.</p>
                        Pegawai
                    </a>
                    <a href="/home/indikator" class="flex items-center {{ Request::is('home/indikator') ? 'active-nav-link' : '' }} text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                        <i class="fas fa-tasks mr-3"></i>
                        <p class="text-sm mr-2">4.</p>
                        Indikator
                    </a>
                    <a href="/home/periode" class="flex items-center {{ Request::is('home/periode') ? 'active-nav-link' : '' }} text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                        <i class="far fa-calendar-alt mr-3"></i>
                        <p class="text-sm mr-2">5.</p>
                        Periode
                    </a>
                    <a href="/home/register_akun" class="flex items-center {{ Request::is('home/register_akun') ? 'active-nav-link' : '' }} text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                        <i class="fas fa-user-plus mr-2"></i>
                        <p class="text-sm mr-1">6.</p>
                        Register Akun
                    </a>
                </div>
            </div>
            @endif
            @endauth
        </nav>
    </aside>

    <div class="w-full flex flex-col h-screen overflow-y-hidden">
        <!-- Desktop Header -->
        <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
            <div class="w-1/2"></div>
            <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                <button @click="isOpen = !isOpen" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                     <div>{{ Auth::user()->nama }}</div>
                     <div class="ms-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
                <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
                <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 account-link hover:text-white">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                    </form>
                </div>
            </div>
        </header>

        <!-- Mobile Header & Nav -->
        <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
            <div class="flex items-center justify-between">
                <a href="index.html" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
                <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                    <i x-show="!isOpen" class="fas fa-bars"></i>
                    <i x-show="isOpen" class="fas fa-times"></i>
                </button>
            </div>

            <!-- Dropdown Nav -->
            <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
                <a href="/home" class="flex items-center {{ Request::is('home') ? 'active-nav-link' : '' }} text-white py-2 pl-4 nav-item opacity-75 hover:opacity-100">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
                <a href="/home/penilaian_kinerja" class="flex items-center {{ Request::is('home/penilaian_kinerja') ? 'active-nav-link' : '' }} text-white opacity-75 hover:opacity-100  py-2 pl-4 nav-item">
                    <i class="fas fa-file-signature mr-3"></i>
                    Penilaian Kinerja
                </a>
                @auth
                @if(Auth::user()->usertype == 'admin')
                    <!-- dropdown sidebar -->
                    <div x-data="{ isOpen: false}">
                        <button @click="isOpen = !isOpen" class="w-full flex items-center text-white font-semibold opacity-75 hover:opacity-100 data py-2 pl-4">
                            <i class="fas fa-table mr-3"></i>
                            <span>Data</span>
                            <i class="fas fa-angle-down ml-2"></i>
                        </button>
                        <div x-show="isOpen" class="text-white ml-5 focus:outline-none overflow-y-auto h-56">
                            <a href="/home/unit_kerja" class="flex items-center {{ Request::is('home/unit_kerja') ? 'active-nav-link' : '' }} text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                        <i class="fas fa-building mr-3"></i>
                        <p class="text-sm mr-2">1.</p>
                        Unit Kerja
                    </a>
                    <a href="/home/jabatan" class="flex items-center {{ Request::is('home/jabatan') ? 'active-nav-link' : '' }} text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                        <i class="fas fa-sitemap mr-3"></i>
                        <p class="text-sm mr-2">2.</p>
                        Jabatan
                    </a>
                    <a href="/home/pegawai" class="flex items-center {{ Request::is('home/pegawai') ? 'active-nav-link' : '' }} text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                        <i class="far fa-id-card mr-3"></i>
                        <p class="text-sm mr-2">3.</p>
                        Pegawai
                    </a>
                    <a href="/home/indikator" class="flex items-center {{ Request::is('home/indikator') ? 'active-nav-link' : '' }} text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                        <i class="fas fa-tasks mr-3"></i>
                        <p class="text-sm mr-2">4.</p>
                        Indikator
                    </a>
                    <a href="/home/periode" class="flex items-center {{ Request::is('home/periode') ? 'active-nav-link' : '' }} text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                        <i class="far fa-calendar-alt mr-3"></i>
                        <p class="text-sm mr-2">5.</p>
                        Periode
                    </a>
                    <a href="/home/register_akun" class="flex items-center {{ Request::is('home/register_akun') ? 'active-nav-link' : '' }} text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                        <i class="fas fa-user-plus mr-2"></i>
                        <p class="text-sm mr-1">6.</p>
                        Register Akun
                    </a>
                        </div>
                    </div>
                @endif
                @endauth
            </nav>
        </header>
    
        <div class="w-full overflow-x-hidden border-t flex flex-col h-screen">
            <main class="w-full flex-grow p-6">
                {{$slot}}
            </main>
            <footer class="w-full bg-white text-right p-4">
                Built by <a target="_blank" href="https://github.com/firasynl" class="underline">Firasyana</a>
                <i class="far fa-handshake"></i><a target="_blank" href="https://github.com/ReginaAyumi" class="underline"> Regina</a>
                .
            </footer>  
        </div>
    </div>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <!-- ChartJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>

    <script>
        // Navigasi
        const navLinks = document.querySelectorAll('.nav-item');

        navLinks.forEach(link => {
            link.addEventListener('click', (event) => {
                navLinks.forEach(navLink => {
                    navLink.classList.remove('active-nav-link');
                });

                link.classList.add('active-nav-link');
            });
        });

        var chartOne = document.getElementById('chartOne');
        var myChart = new Chart(chartOne, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var chartTwo = document.getElementById('chartTwo');
        var myLineChart = new Chart(chartTwo, {
            type: 'line',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
    
</body>
@include('sweetalert::alert')
</html>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
    <div class="container">
        <a class="navbar-brand font-signika font-weight-500" href="{{ url('/') }}">Sanggar Cerry</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                    <a class="nav-link font-14 font-poppins text-dark" href="{{ url('/') }}">Beranda</a>
                </li>

                <li class="nav-item {{ request()->is('jadwal') || request()->is('jadwal/*') ? 'active' : '' }}">
                    <a class="nav-link font-14 font-poppins text-dark" href="{{ route('jadwal.index') }}">Jadwal</a>
                </li>

                <li class="nav-item {{ request()->is('pengumuman') || request()->is('pengumuman/*') ? 'active' : '' }}">
                    <a class="nav-link font-14 font-poppins text-dark" href="{{ route('pengumuman.index') }}">Pengumuman</a>
                </li>

                @if(auth()->user())

                    <li class="nav-item {{ request()->is('siswa') || request()->is('siswa/*') ? 'active' : '' }}">
                        <a class="nav-link font-14 font-poppins text-dark" href="{{ route('siswa.index') }}">Siswa</a>
                    </li>
                    <li class="nav-item {{ request()->is('absen') || request()->is('absen/*') || request()->is('absen-siswa/*') ? 'active' : '' }}">
                        <a class="nav-link font-14 font-poppins text-dark" href="{{ route('absen.index') }}">Absen</a>
                    </li>
                    @if(auth()->user()->role == 'admin')
                        <li class="nav-item {{ request()->is('guru') || request()->is('guru/*') ? 'active' : '' }}">
                            <a class="nav-link font-14 font-poppins text-dark" href="{{ route('guru.index') }}">Guru</a>
                        </li>
                        <li class="nav-item {{ request()->is('orangtua') || request()->is('orangtua/*') ? 'active' : '' }}">
                            <a class="nav-link font-14 font-poppins text-dark" href="{{ route('orangtua.index') }}">Orangtua</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link font-14 font-poppins text-dark" href="{{ url('/logout') }}">Logout</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link font-14 font-poppins btn btn-success px-4 text-white" href="{{ url('/login') }}">Login</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

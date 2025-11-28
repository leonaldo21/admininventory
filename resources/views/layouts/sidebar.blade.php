<div id="sidebar" class="sidebar vh-100 d-flex flex-column p-3 shadow-lg"
     style="width: 250px; background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%); color: #e2e8f0;">

    <div class="text-center mb-4">
        <h4 class="fw-bold text-info mb-1">📊 Timesheet</h4>
        <hr class="border-secondary opacity-50">
    </div>

    <ul class="nav flex-column gap-2">
        {{-- Dashboard --}}
        <li class="nav-item">
            <a href="{{ route('dashboard') }}"
               class="nav-link d-flex align-items-center px-3 py-2 rounded-3 fw-semibold {{ request()->routeIs('dashboard') ? 'active-link' : 'text-light' }}">
                <span class="icon-circle me-3"><i class="bi bi-speedometer2"></i></span>
                Dashboard
            </a>
        </li>

        {{-- Pegawai --}}
        <li class="nav-item">
            <a href="{{ route('pegawai.index') }}"
               class="nav-link d-flex align-items-center px-3 py-2 rounded-3 fw-semibold {{ request()->routeIs('pegawai.*') ? 'active-link' : 'text-light' }}">
                <span class="icon-circle me-3"><i class="bi bi-people-fill"></i></span>
                Pegawai
            </a>
        </li>

        {{-- Barang --}}
        <li class="nav-item">
            <a href="{{ route('barang.index') }}"
               class="nav-link d-flex align-items-center px-3 py-2 rounded-3 fw-semibold {{ request()->routeIs('barang.*') && !request()->routeIs('barang_masuk.*') && !request()->routeIs('barang_keluar.*') ? 'active-link' : 'text-light' }}">
                <span class="icon-circle me-3"><i class="bi bi-box-seam"></i></span>
                Barang
            </a>
        </li>
        
        {{-- Barang Masuk --}}
        <li class="nav-item">
            <a href="{{ route('barang_masuk.index') }}"
               class="nav-link d-flex align-items-center px-3 py-2 rounded-3 fw-semibold {{ request()->routeIs('barang_masuk.*') ? 'active-link' : 'text-light' }}">
                <span class="icon-circle me-3"><i class="bi bi-box-arrow-in-down"></i></span>
                Barang Masuk
            </a>
        </li>

        {{-- Barang Keluar --}}
        <li class="nav-item">
            <a href="{{ route('barang_keluar.index') }}"
               class="nav-link d-flex align-items-center px-3 py-2 rounded-3 fw-semibold {{ request()->routeIs('barang_keluar.*') ? 'active-link' : 'text-light' }}">
                <span class="icon-circle me-3"><i class="bi bi-box-arrow-up"></i></span>
                Barang Keluar
            </a>
        </li>
        
        {{-- Absensi --}}
        <li class="nav-item">
            <a href="{{ route('absensi.index') }}"
               class="nav-link d-flex align-items-center px-3 py-2 rounded-3 fw-semibold {{ request()->routeIs('absensi.*') ? 'active-link' : 'text-light' }}">
                <span class="icon-circle me-3"><i class="bi bi-calendar-check"></i></span>
                Absensi
            </a>
        </li>
    </ul>

    <div class="mt-auto pt-4 border-top border-secondary opacity-50">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                    class="btn btn-link nav-link d-flex align-items-center text-danger fw-semibold px-3 py-2">
                <span class="icon-circle me-3 text-danger"><i class="bi bi-box-arrow-right"></i></span>
                Logout
            </button>
        </form>
    </div>
</div>

<style>
.sidebar .nav-link {
    color: #cbd5e1;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
}
.sidebar .nav-link:hover {
    background: rgba(255, 255, 255, 0.08);
    color: #fff !important;
    transform: translateX(5px);
}
.sidebar .active-link {
    background: linear-gradient(90deg, #0d6efd, #6366f1);
    color: #fff !important;
    box-shadow: 0 0 12px rgba(13, 110, 253, 0.6);
}
.icon-circle {
    width: 32px;
    height: 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    color: #9ca3af;
    transition: all 0.3s ease;
}
.nav-link:hover .icon-circle,
.active-link .icon-circle {
    background: rgba(255, 255, 255, 0.25);
    color: #fff;
}
</style>
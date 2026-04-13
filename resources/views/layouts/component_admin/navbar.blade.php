<nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="false">
  <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">

    {{-- BREADCRUMB --}}
    <nav>
      <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
        <li class="text-sm leading-normal">
          <a class="text-white opacity-50" href="{{ route('admin.dashboard') }}">Admin</a>
        </li>
        <li class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']" aria-current="page">
          {{ ucfirst(str_replace(['-','_'], ' ', request()->segment(2) ?? 'Dashboard')) }}
        </li>
      </ol>
      <h6 class="mb-0 font-bold text-white capitalize">
        {{ ucfirst(str_replace(['-','_'], ' ', request()->segment(2) ?? 'Dashboard')) }}
      </h6>
    </nav>

    {{-- RIGHT SIDE --}}
    <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
      <ul class="flex flex-row items-center justify-end pl-0 mb-0 list-none gap-1 md-max:w-full ml-auto">

        {{-- NOTIFIKASI PESANAN PENDING --}}
        @php
          $navPending = \App\Models\Payment::where('status','pending')->count();
        @endphp
        <li class="relative flex items-center px-2">
          <a href="{{ route('admin.payments.index') }}"
             class="block p-0 text-sm text-white transition-all ease-nav-brand"
             style="position:relative;">
            <i class="fa fa-bell" style="font-size:16px;"></i>
            @if($navPending > 0)
            <span style="position:absolute;top:-6px;right:-8px;background:#f953c6;color:#fff;font-size:9px;font-weight:800;width:16px;height:16px;border-radius:50%;display:flex;align-items:center;justify-content:center;border:2px solid rgba(255,255,255,0.3);">
              {{ $navPending > 9 ? '9+' : $navPending }}
            </span>
            @endif
          </a>
        </li>

        {{-- DIVIDER --}}
        <li style="width:1px;height:20px;background:rgba(255,255,255,0.2);margin:0 6px;"></li>

        {{-- USER DROPDOWN --}}
        <li class="relative flex items-center" x-data="{ open: false }">
          <button
            @click="open = !open"
            @click.away="open = false"
            style="display:flex;align-items:center;gap:8px;background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.2);border-radius:10px;padding:6px 12px;cursor:pointer;color:#fff;font-size:0.82rem;font-weight:600;transition:all 0.2s;"
            onmouseover="this.style.background='rgba(255,255,255,0.18)'"
            onmouseout="this.style.background='rgba(255,255,255,0.1)'"
          >
            {{-- Avatar inisial --}}
            <span style="width:28px;height:28px;border-radius:8px;background:linear-gradient(135deg,#11998e,#38ef7d);display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:800;color:#fff;flex-shrink:0;">
              {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}
            </span>
            <span class="hidden sm:inline" style="max-width:120px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
              {{ auth()->user()->name ?? 'Admin' }}
            </span>
            <i class="fa fa-chevron-down" style="font-size:10px;opacity:0.7;"></i>
          </button>

          {{-- Dropdown Menu --}}
          <div
            x-show="open"
            x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            style="position:absolute;top:calc(100% + 10px);right:0;width:200px;background:#fff;border-radius:12px;box-shadow:0 10px 40px rgba(0,0,0,0.15);border:1px solid rgba(0,0,0,0.06);z-index:9999;overflow:hidden;display:none;"
            :style="open ? 'display:block' : 'display:none'"
          >
            {{-- User info --}}
            <div style="padding:14px 16px;border-bottom:1px solid #f1f5f9;">
              <div style="font-size:0.85rem;font-weight:700;color:#1a1a2e;">{{ auth()->user()->name ?? 'Admin' }}</div>
              <div style="font-size:0.72rem;color:#94a3b8;margin-top:2px;">{{ auth()->user()->email ?? '' }}</div>
              <div style="margin-top:6px;">
                <span style="background:#f0fdf4;color:#16a34a;font-size:0.65rem;font-weight:700;padding:2px 8px;border-radius:99px;border:1px solid #bbf7d0;text-transform:uppercase;">
                  {{ auth()->user()->role ?? 'admin' }}
                </span>
              </div>
            </div>

            {{-- Logout --}}
            <div style="padding:8px;border-top:1px solid #f1f5f9;">
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                  style="display:flex;align-items:center;gap:10px;padding:9px 12px;border-radius:8px;width:100%;border:none;background:transparent;cursor:pointer;color:#dc2626;font-size:0.82rem;font-weight:600;transition:background 0.15s;font-family:inherit;"
                  onmouseover="this.style.background='#fef2f2'" onmouseout="this.style.background=''">
                  <i class="ni ni-user-run" style="font-size:14px;width:16px;text-align:center;"></i>
                  Logout
                </button>
              </form>
            </div>
          </div>
        </li>

        {{-- Mobile hamburger --}}
        <li class="flex items-center pl-3 xl:hidden">
          <a href="javascript:;" class="block p-0 text-sm text-white transition-all ease-nav-brand" sidenav-trigger>
            <div class="w-4.5 overflow-hidden">
              <i class="ease mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all"></i>
              <i class="ease mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all"></i>
              <i class="ease relative block h-0.5 rounded-sm bg-white transition-all"></i>
            </div>
          </a>
        </li>

      </ul>
    </div>
  </div>
</nav>

{{-- Alpine.js untuk dropdown (load sekali) --}}
@once
@push('scripts')
<script>
  // Fallback jika tidak pakai Alpine.js — pakai vanilla JS
  document.addEventListener('DOMContentLoaded', function() {
    var btn = document.querySelector('[\\@click]');
    // Cek apakah Alpine.js sudah ada
    if (typeof Alpine === 'undefined') {
      // Fallback manual dropdown
      document.querySelectorAll('[x-data]').forEach(function(wrapper) {
        var trigger = wrapper.querySelector('button');
        var menu = wrapper.querySelector('[x-show]');
        if (!trigger || !menu) return;
        menu.style.display = 'none';
        trigger.addEventListener('click', function(e) {
          e.stopPropagation();
          var isOpen = menu.style.display === 'block';
          menu.style.display = isOpen ? 'none' : 'block';
        });
        document.addEventListener('click', function() {
          menu.style.display = 'none';
        });
      });
    }
  });
</script>
@endpush
@endonce

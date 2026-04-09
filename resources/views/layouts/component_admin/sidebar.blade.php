<aside class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl dark:shadow-none dark:bg-slate-850 max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0" aria-expanded="false">

  <div class="relative">
    <i class="absolute top-0 right-0 p-4 opacity-50 cursor-pointer fas fa-times dark:text-white text-slate-400 xl:hidden" sidenav-close></i>

   <i class="absolute top-0 right-0 p-4 opacity-50 cursor-pointer fas fa-times dark:text-white text-slate-400 xl:hidden" sidenav-close></i>

    <a class="block px-8 py-4 m-0 whitespace-nowrap text-center" href="{{ route('admin.dashboard') }}">
      <div class="flex flex-col items-center justify-center">
        <span class="text-xl font-bold tracking-tight dark:text-white text-slate-800">
          Dapur Ibu Iim
        </span>

        <span class="text-[11px] font-bold tracking-[0.15em] text-blue-500 uppercase mt-1">
          Panel Admin
        </span>
      </div>
    </a>
  </div>


<hr class="h-px mt-2 bg-transparent bg-gradient-to-r from-transparent via-black/10 to-transparent dark:via-white/20" />

      <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />
        <ul class="flex flex-col pl-0 mb-0">
          {{-- MENU UTAMA --}}
      <li class="w-full mt-4">
        <h6 class="pl-6 ml-2 text-xs font-bold leading-tight uppercase dark:text-white opacity-60">Menu Utama</h6>
      </li>

      <li class="mt-0.5 w-full">
        <a class="{{ request()->routeIs('admin.dashboard') ? 'bg-blue-500/10 font-semibold' : '' }} py-2.7 dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 text-slate-700 transition-colors"
           href="{{ route('admin.dashboard') }}">
          <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <i class="relative top-0 text-sm leading-normal text-blue-500 ni ni-tv-2"></i>
          </div>
          <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Dashboard</span>
        </a>
      </li>

      <li class="mt-0.5 w-full">
        <a class="{{ request()->routeIs('admin.categories.*') ? 'bg-blue-500/10 font-semibold' : '' }} py-2.7 dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 text-slate-700 transition-colors"
           href="{{ route('admin.categories.index') }}">
          <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <i class="relative top-0 text-sm leading-normal text-orange-500 ni ni-bullet-list-67"></i>
          </div>
          <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Kategori</span>
        </a>
      </li>

      <li class="mt-0.5 w-full">
        <a class="{{ request()->routeIs('admin.menus.*') ? 'bg-blue-500/10 font-semibold' : '' }} py-2.7 dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 text-slate-700 transition-colors"
           href="{{ route('admin.menus.index') }}">
          <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <i class="relative top-0 text-sm leading-normal text-emerald-500 ni ni-basket"></i>
          </div>
          <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Menu</span>
        </a>
      </li>

      <li class="mt-0.5 w-full">
        <a class="{{ request()->routeIs('admin.menu-variants.*') ? 'bg-blue-500/10 font-semibold' : '' }} py-2.7 dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 text-slate-700 transition-colors"
           href="{{ route('admin.menu-variants.index') }}">
          <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <i class="relative top-0 text-sm leading-normal text-emerald-500 ni ni-tag"></i>
          </div>
          <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Varian Menu</span>
        </a>
      </li>

      <li class="mt-0.5 w-full">
        <a class="{{ request()->routeIs('admin.menu-items.*') ? 'bg-blue-500/10 font-semibold' : '' }} py-2.7 dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 text-slate-700 transition-colors"
           href="{{ route('admin.menu-items.index') }}">
          <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <i class="relative top-0 text-sm leading-normal text-emerald-500 ni ni-align-left-2"></i>
          </div>
          <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Menu Items</span>
        </a>
      </li>

      <li class="mt-0.5 w-full">
        <a class="{{ request()->routeIs('admin.menu-addons.*') ? 'bg-blue-500/10 font-semibold' : '' }} py-2.7 dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 text-slate-700 transition-colors"
           href="{{ route('admin.menu-addons.index') }}">
          <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <i class="relative top-0 text-sm leading-normal text-pink-500 ni ni-fat-add"></i>
          </div>
          <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Menu Addons</span>
        </a>
      </li>
      <li class="mt-0.5 w-full">
        <a class="{{ request()->routeIs('admin.blogs.*') ? 'bg-blue-500/10 font-semibold' : '' }} py-2.7 dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 text-slate-700 transition-colors"
            href="{{ route('admin.blogs.index') }}">

            <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg">
            <i class="text-green-500 ni ni-single-copy-04"></i>
            </div>

            <span class="ml-1">Blog</span>
        </a>
     </li>

      {{-- OPERASIONAL --}}
      <li class="w-full mt-4">
        <h6 class="pl-6 ml-2 text-xs font-bold leading-tight uppercase dark:text-white opacity-60">Operasional</h6>
      </li>

      <li class="mt-0.5 w-full">
        <a class="{{ request()->routeIs('admin.orders.*') ? 'bg-blue-500/10 font-semibold' : '' }} py-2.7 dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 text-slate-700 transition-colors"
           href="{{ route('admin.orders.index') }}">
          <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <i class="relative top-0 text-sm leading-normal text-red-500 ni ni-cart"></i>
          </div>
          <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Pesanan</span>
        </a>
      </li>

      <li class="mt-0.5 w-full">
        <a class="{{ request()->routeIs('admin.order-schedules.*') ? 'bg-blue-500/10 font-semibold' : '' }} py-2.7 dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 text-slate-700 transition-colors"
           href="{{ route('admin.order-schedules.index') }}">
          <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <i class="relative top-0 text-sm leading-normal text-blue-500 ni ni-calendar-grid-58"></i>
          </div>
          <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Jadwal Pesanan</span>
        </a>
      </li>

      {{-- KEUANGAN --}}
      <li class="w-full mt-4">
        <h6 class="pl-6 ml-2 text-xs font-bold leading-tight uppercase dark:text-white opacity-60">Keuangan</h6>
      </li>

      <li class="mt-0.5 w-full">
        <a class="{{ request()->routeIs('admin.expense-categories.*') ? 'bg-blue-500/10 font-semibold' : '' }} py-2.7 dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 text-slate-700 transition-colors"
           href="{{ route('admin.expense-categories.index') }}">
          <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <i class="relative top-0 text-sm leading-normal text-orange-500 ni ni-archive-2"></i>
          </div>
          <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Kat. Pengeluaran</span>
        </a>
      </li>

      <li class="mt-0.5 w-full">
        <a class="{{ request()->routeIs('admin.expenses.*') ? 'bg-blue-500/10 font-semibold' : '' }} py-2.7 dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 text-slate-700 transition-colors"
           href="{{ route('admin.expenses.index') }}">
          <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <i class="relative top-0 text-sm leading-normal text-red-500 ni ni-money-coins"></i>
          </div>
          <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Pengeluaran</span>
        </a>
      </li>

      {{-- AKUN --}}
      <li class="w-full mt-4">
        <h6 class="pl-6 ml-2 text-xs font-bold leading-tight uppercase dark:text-white opacity-60">Akun</h6>
      </li>

      <li class="mt-0.5 w-full">
        <a class="py-2.7 dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 text-slate-700 transition-colors" href="#">
          <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <i class="relative top-0 text-sm leading-normal text-slate-500 ni ni-single-02"></i>
          </div>
          <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Profil</span>
        </a>
      </li>

      <li class="mt-0.5 w-full mb-4">
        <div class="py-2.7 dark:text-white dark:opacity-80 text-sm my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 text-slate-700">
          <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <i class="relative top-0 text-sm leading-normal text-red-500 ni ni-button-power"></i>
          </div>
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="text-sm text-red-500 font-semibold bg-transparent border-0 cursor-pointer p-0 m-0">
              Logout
            </button>
          </form>
        </div>
      </li>

        </ul>
    </aside>


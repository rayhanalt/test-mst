<div class="navbar rounded-xl bg-base-100 shadow-xl">

    <div data-aos-duration="500" data-aos="fade-down" class="flex-none">
        <label for="my-drawer" class="btn btn-ghost btn-square">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                class="inline-block h-5 w-5 stroke-current">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </label>
    </div>
    <div data-aos-duration="600" data-aos="fade-down" class="flex-1">
        <a href="/" class="btn btn-ghost text-xl normal-case">Home</a>
    </div>

    <div data-aos-duration="800" data-aos="fade-down" class="flex-2 mr-3">
        <span class="btn btn-ghost text-sm normal-case">
            @if (auth()->user()->jabatan == 'guru')
                {{ auth()->user()->hasGuru->nama_guru }} | {{ auth()->user()->jabatan }}
            @elseif (auth()->user()->jabatan == 'siswa')
                {{ auth()->user()->hasSiswa->nama_panggilan }} | {{ auth()->user()->jabatan }}
            @else
                {{ auth()->user()->username }}
            @endif
            <br>
        </span>
    </div>
    <div data-aos-duration="1000" data-aos="fade-down" class="flex-none">
        @if (auth()->user())
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="btn-outline btn-error btn">Logout</button>
            </form>
        @else
            <a href="/login" class="btn-outline btn btn-info">
                Login
            </a>
        @endif
    </div>
</div>

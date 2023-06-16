<div>
    <div class="fixed top-[72px] bottom-2 right-2 left-2 flex flex-grow justify-between">
        <div>
            <a href="/mapel/create" class="btn-success btn-outline btn btn-sm mr-2">➕ Data</a>
        </div>
        <div>
            @include('layout.notif')
        </div>
        <div>
            <input wire:model="search" type="text" class="input-info input input-sm ml-2"
                placeholder="Search, if date: 'Y-m-d'">
        </div>
    </div>
    <table class="mt-10 table w-full">
        <!-- head -->
        <thead class="sticky top-0">
            <tr>
                <th></th>
                <th>Kode Mapel</th>
                <th>Nama Mapel</th>

                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <th>{{ $loop->iteration + $data->FirstItem() - 1 }}</th>
                    <td>{{ $item->kode_mapel }}</td>
                    <td>{{ $item->nama_mapel }}</td>

                    <td>
                        <a href="/mapel/{{ $item->kode_mapel }}/edit" class="btn-accent btn-outline btn btn-sm mb-1">
                            ✎
                        </a>
                        <form action="/mapel/{{ $item->kode_mapel }}" method="POST">
                            @method('delete')
                            @csrf
                            <button class="btn-outline btn-error btn btn-sm"
                                onclick="return confirm('yakin hapus data {{ $item->nama_mapel }} ?')">
                                🗑
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="fixed bottom-28 left-0 right-0">
        <div class="btn-group mx-auto grid w-fit grid-cols-2">
            <button wire:click="previousPage" @if ($data->onFirstPage()) disabled @endif
                class="btn-outline btn btn-sm">previous</button>

            <button wire:click="nextPage" @if (!$data->hasMorePages()) disabled @endif
                class="btn-outline btn btn-sm">next</button>
        </div>
    </div>
</div>

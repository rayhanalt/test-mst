<div>
    <div class="fixed top-[72px] bottom-2 right-2 left-2 flex flex-grow justify-between">
        <div>
            <a href="/transaksi/create" class="btn-outline btn btn-success btn-sm mr-2">➕ Data</a>
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
                <th>Kode Transaksi</th>
                <th>Tanggal</th>
                <th>Nama Customer</th>
                <th>Jumlah Barang</th>
                <th>Sub Total</th>
                <th>Diskon</th>
                <th>Ongkir</th>
                <th>Total</th>

                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <th>{{ $loop->iteration + $data->FirstItem() - 1 }}</th>
                    <td>{{ $item->kode }}</td>
                    <td>{{ date('d F Y', strtotime($item->tgl)) }}</td>
                    <td>{{ $item->hasCust->nama }}</td>
                    <td>{{ $item->getSalesDet()->where('kode_sales', $item->kode)->sum('qty') }}</td>
                    <td>{{ 'Rp. ' . number_format($item->subtotal, 0, ',', '.') }}</td>
                    <td>{{ 'Rp. ' . number_format($item->diskon, 0, ',', '.') }}</td>
                    <td>{{ 'Rp. ' . number_format($item->ongkir, 0, ',', '.') }}</td>
                    <td>{{ 'Rp. ' . number_format($item->total_bayar, 0, ',', '.') }}</td>

                    <td>
                        <a href="/transaksi/{{ $item->kode }}/edit" class="btn-outline btn btn-accent btn-sm mb-1">
                            ✎
                        </a>
                        <form action="/transaksi/{{ $item->kode }}" method="POST">
                            @method('delete')
                            @csrf
                            <button class="btn-outline btn btn-error btn-sm"
                                onclick="return confirm('yakin hapus data {{ $item->kode }} ?')">
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

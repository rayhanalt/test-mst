@extends('app')
@section('content')
    <div class="mt-20 flex place-content-center lg:mt-0">
        <div class="stats stats-vertical m-auto h-auto shadow-lg shadow-black ring-1 ring-slate-400 lg:stats-horizontal xl:stats-horizontal"
            data-aos="zoom-out" data-aos-duration="500">

            <div class="stat">
                <div class="stat-figure text-secondary">

                    <svg width="56px" height="56px" viewBox="0 0 16 16" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" class="si-glyph si-glyph-person-public">


                        <defs></defs>
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(0.000000, 3.000000)" fill="#898e96">
                                <path
                                    d="M9.855,7.053 C9.432,7.624 8.021,7.772 8.021,7.772 C8.021,7.772 6.58,7.63 6.156,7.066 C4.121,7.066 3.058,9.989 3.058,9.989 L12.984,9.989 C12.984,9.988 12.146,7.053 9.855,7.053 L9.855,7.053 Z"
                                    class="si-glyph-fill"></path>
                                <path
                                    d="M9.943,2.918 C9.943,3.977 9.062,6 7.978,6 C6.89,6 6.011,3.977 6.011,2.918 C6.011,1.859 6.89,1 7.978,1 C9.062,1 9.943,1.859 9.943,2.918 L9.943,2.918 Z"
                                    class="si-glyph-fill"></path>
                                <path
                                    d="M14.104,5.021 C13.733,5.596 12.577,5.902 12.577,5.902 C12.577,5.902 11.222,5.601 10.848,5.035 C10.848,5.035 10.836,5.699 10.271,6.471 C12.071,6.239 12.849,7.974 12.849,7.974 L15.98,7.98 C15.979,7.979 16.119,5.021 14.104,5.021 L14.104,5.021 Z"
                                    class="si-glyph-fill"></path>
                                <path
                                    d="M13.99,1.533 C13.99,2.381 13.328,3.998 12.511,3.998 C11.691,3.998 11.03,2.381 11.03,1.533 C11.03,0.687 11.693,0 12.511,0 C13.328,0 13.99,0.688 13.99,1.533 L13.99,1.533 Z"
                                    class="si-glyph-fill"></path>
                                <path
                                    d="M1.918,5.021 C2.296,5.592 3.467,5.896 3.467,5.896 C3.467,5.896 4.84,5.597 5.215,5.035 C5.215,5.035 5.229,5.695 5.801,6.461 C3.977,6.231 3.191,7.953 3.191,7.953 L0.021,7.958 C0.021,7.958 -0.122,5.021 1.918,5.021 L1.918,5.021 Z"
                                    class="si-glyph-fill"></path>
                                <path
                                    d="M2.002,1.566 C2.002,2.394 2.666,3.977 3.481,3.977 C4.3,3.977 4.961,2.394 4.961,1.566 C4.961,0.737 4.299,0.065 3.481,0.065 C2.664,0.065 2.002,0.737 2.002,1.566 L2.002,1.566 Z"
                                    class="si-glyph-fill"></path>
                            </g>
                        </g>
                    </svg>
                </div>
                <div class="stat-title">Jumlah Data Customer</div>
                <div class="stat-value">{{ $customer }}</div>
            </div>

            <div class="stat">
                <div class="stat-figure text-secondary">
                    <svg width="46px" height="46px" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <rect x="9" y="2" width="6" height="6" rx="1" stroke="#898e96"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4 18V14C4 13.4477 4.44772 13 5 13H19C19.5523 13 20 13.4477 20 14V18" stroke="#898e96"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <circle cx="4" cy="20" r="2" stroke="#898e96" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <circle cx="20" cy="20" r="2" stroke="#898e96" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <circle cx="12" cy="20" r="2" stroke="#898e96" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M12 8V18" stroke="#898e96" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="stat-title">Jumlah Data Transaksi</div>
                <div class="stat-value">{{ $transaksi }}</div>
            </div>

            <div class="stat">
                <div class="stat-figure text-secondary">
                    <svg width="56px" height="56px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"
                        fill="#898e96">
                        <path
                            d="M464 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48zm-6 400H54a6 6 0 0 1-6-6V86a6 6 0 0 1 6-6h404a6 6 0 0 1 6 6v340a6 6 0 0 1-6 6zm-42-92v24c0 6.627-5.373 12-12 12H204c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h200c6.627 0 12 5.373 12 12zm0-96v24c0 6.627-5.373 12-12 12H204c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h200c6.627 0 12 5.373 12 12zm0-96v24c0 6.627-5.373 12-12 12H204c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h200c6.627 0 12 5.373 12 12zm-252 12c0 19.882-16.118 36-36 36s-36-16.118-36-36 16.118-36 36-36 36 16.118 36 36zm0 96c0 19.882-16.118 36-36 36s-36-16.118-36-36 16.118-36 36-36 36 16.118 36 36zm0 96c0 19.882-16.118 36-36 36s-36-16.118-36-36 16.118-36 36-36 36 16.118 36 36z" />
                    </svg>
                </div>
                <div class="stat-title">Jumlah Data Barang</div>
                <div class="stat-value">{{ $barang }}</div>
            </div>

        </div>
    </div>
@endsection

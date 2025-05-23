<x-layout>
    <x-slot:title>Peramalan</x-slot:title>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">{{ str_replace('_', ' ', config('app.name')) }}</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Peramalan</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="mb-0 text-uppercase">Peramalan Produksi Tahu</h6>
        </div>

        <hr />
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">Produksi Besok</p>
                                <h4 class="my-2 mb-2">
                                    {{ isset($hari->hasil_peramalan) ? floatval(round($hari->hasil_peramalan, 2)) : '-' }}
                                </h4>
                            </div>
                            <div class="widgets-icons ms-auto"><i class='bx bx-line-chart'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">Rata-Rata MAPE</p>
                                <h4 class="my-2 mb-2">{{ floatval(round($mape, 2)) }}%</h4>
                            </div>
                            <div class="widgets-icons ms-auto"><i class='bx bx-error'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">ALPHA</p>
                                <h4 class="my-2 mb-2">{{ floatval(round($alpha, 1)) }}
                                </h4>
                            </div>
                            <div class="dropdown ms-auto">
                                <a class="widgets-icons dropdown-toggle dropdown-toggle-nocaret" href="#"
                                    data-bs-toggle="dropdown" >
                                    <i class='bx bx-slider-alt'></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-item d-flex justify-content-between align-items-center">
                                        <span class="me-5">ALPHA</span>
                                        <span class="me-5">MAPE</span>
                                        <span class="me-5">MAE</span>
                                        <span class="me-5">MSE</span>
                                        <span class="me-5">RMSE</span>
                                        <span>MASE</span>
                                    </li>
                                    @foreach ($alphas as $item)
                                        <li>
                                            <form action="{{ route('alpha.update') }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="alpha" value="{{ $item['alpha'] }}">
                                                <button type="submit"
                                                    class="dropdown-item d-flex justify-content-between align-items-center {{ $item['alpha'] == $bestMape || $item['alpha'] == $bestRmse ? 'bg-success text-white' : ($item['alpha'] == $alpha ? 'bg-secondary text-white' : '') }}">
                                                    <span>{{ $item['alpha'] }}</span>
                                                    <span>{{ $item['mape'] }}%</span>
                                                    <span>{{ $item['mae'] }}</span>
                                                    <span>{{ $item['mse'] }}</span>
                                                    <span>{{ $item['rmse'] }}</span>
                                                    <span>{{ $item['mase'] }}</span>
                                                </button>
                                            </form>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">Produksi MAE</p>
                                <h4 class="my-2 mb-2">{{ floatval(round($mae, 2)) }}</h4>
                            </div>
                            <div class="widgets-icons ms-auto"><i class='bx bx-line-chart'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">Rata-Rata MSE</p>
                                <h4 class="my-2 mb-2">{{ floatval(round($mse, 2)) }}</h4>
                            </div>
                            <div class="widgets-icons ms-auto"><i class='bx bx-error'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">Rata-Rata RMSE</p>
                                <h4 class="my-2 mb-2">{{ floatval(round($rmse, 2)) }}</h4>
                            </div>
                            <div class="widgets-icons ms-auto"><i class='bx  bx-analyse'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">Rata-Rata MASE</p>
                                <h4 class="my-2 mb-2">{{ floatval(round($mase, 2)) }}</h4>
                            </div>
                            <div class="widgets-icons ms-auto"><i class='bx  bx-analyse'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable" class="table align-middle mb-0 table-hover">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 10px;">No</th>
                            <th>Tanggal</th>
                            <th>Penjualan</th>
                            <th>Peramalan</th>
                            <th>Absolut Error</th>
                            <th>MAPE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peramalans as $peramalan)
                            <tr>
                                <td style="text-align: center;">{{ $loop->iteration }}</td>
                                <td>{{ strftime('%d %B %Y', strtotime($peramalan->penjualan->tanggal)) }}</td>
                                <td>{{ $peramalan->penjualan->jumlah_terjual }}</td>
                                <td>{{ floatval(round($peramalan->hasil_peramalan, 2)) }}</td>
                                <td>{{ floatval(round($peramalan->error, 2)) }}</td>
                                <td>{{ floatval(round($peramalan->mape, 2)) }} %</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

</x-layout>

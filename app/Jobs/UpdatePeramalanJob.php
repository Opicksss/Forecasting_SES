<?php

namespace App\Jobs;

use App\Models\Alpha;
use App\Models\Penjualan;
use App\Models\Peramalan;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdatePeramalanJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    // public function handle(): void
    // {
    //     //
    // }

    public function handle()
    {
        $alpha = Alpha::latest()->first()->alpha ?? 0.5;

        // Kosongkan semua data peramalan
        Peramalan::truncate();

        // Ambil semua penjualan dan urutkan berdasarkan tanggal (supaya SES-nya berurutan)
        $penjualans = Penjualan::orderBy('tanggal')->get();

        $F_prev = null;

        foreach ($penjualans as $penjualan) {
            $A_t = $penjualan->jumlah_terjual;

            // Jika pertama kali, forecast = actual
            if (is_null($F_prev)) {
                $F_prev = $A_t;
            }

            // Peramalan sekarang
            $F_t = $alpha * $A_t + (1 - $alpha) * $F_prev;

            // Error & MAPE
            $error = abs($A_t - $F_prev);
            $mape = $A_t != 0 ? abs(($A_t - $F_prev) / $A_t) * 100 : 0;

            // Simpan hasil peramalan
            Peramalan::create([
                'hasil_peramalan' => $F_t,
                'error' => $error,
                'mape' => $mape,
                'penjualan_id' => $penjualan->id,
            ]);

            // Update forecast sebelumnya
            $F_prev = $F_t;
        }
    }
}

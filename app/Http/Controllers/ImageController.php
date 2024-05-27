<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function download($proof_payment)
{
        $filePath = public_path('bukti/'.$proof_payment);
        if (file_exists($filePath)) {
            $originalFileName = pathinfo($proof_payment, PATHINFO_FILENAME);
            $extension = pathinfo($proof_payment, PATHINFO_EXTENSION);

            $newFileName = 'buktiPembayaran.'.$extension; // Nama baru yang diinginkan untuk file yang diunduh
            return response()->download($filePath, $newFileName);
        }
        return back()->with('info', 'Bukti belum ada.');
}

}

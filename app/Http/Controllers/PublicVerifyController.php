<?php

namespace App\Http\Controllers;

use App\Models\SkSubmission;
use Illuminate\Http\Request;

class PublicVerifyController extends Controller
{
    /**
     * Display public SK authenticity verification result via QR code SHA-256 hash.
     */
    public function show(string $hash)
    {
        $submission = SkSubmission::with(['template', 'kelurahan', 'approver'])
            ->where('tte_hash', $hash)
            ->first();

        return view('public.verify', compact('submission', 'hash'));
    }
}

<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - SIP-SK-Utara
|--------------------------------------------------------------------------
|
| - / : Redirect / Dashboard
| - /dashboard : Dashboard statistik
| - /templates : Dynamic SK Template Management (CRUD)
| - /submissions : Submissions Drafting (Kelurahan)
| - /verification/kecamatan : Verifikasi Tingkat Kecamatan
| - /verification/hukum : Penomoran Resmi Bagian Hukum (Setda)
| - /verification/camat : Otorisasi & TTE Camat
| - /verify-sk/{hash} : Portal Verifikasi Keaslian SK Publik
|
*/

Route::get('/', function () {
    return view('welcome');
});

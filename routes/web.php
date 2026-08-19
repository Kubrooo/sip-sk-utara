<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicVerifyController;
use App\Http\Controllers\SkSubmissionController;
use App\Http\Controllers\SkTemplateController;
use App\Http\Controllers\SkVerificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Portal Verifikasi Keaslian Dokumentasi SK via Scan QR Code Hash
Route::get('/verify-sk/{hash}', [PublicVerifyController::class, 'show'])->name('public.verify');

Route::get('/', function () {
    return redirect()->route('dashboard');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // 1. Dashboard Utama (Semua Peran)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Daftar Permohonan SK & Detail (Dapat diakses oleh Semua Peran)
    Route::get('/submissions', [SkSubmissionController::class, 'index'])->name('submissions.index');
    Route::get('/submissions/{submission}', [SkSubmissionController::class, 'show'])->name('submissions.show');
    Route::get('/submissions/{submission}/pdf', [SkSubmissionController::class, 'downloadPdf'])->name('submissions.pdf');

    // 3. Submissions Drafting & Inisiasi (Khusus Admin Kelurahan)
    Route::middleware(['role:admin_kelurahan'])->group(function () {
        Route::get('/submissions/create', [SkSubmissionController::class, 'create'])->name('submissions.create');
        Route::post('/submissions', [SkSubmissionController::class, 'store'])->name('submissions.store');
        Route::get('/submissions/{submission}/edit', [SkSubmissionController::class, 'edit'])->name('submissions.edit');
        Route::put('/submissions/{submission}', [SkSubmissionController::class, 'update'])->name('submissions.update');
        Route::post('/submissions/{submission}/submit', [SkSubmissionController::class, 'submitToKecamatan'])->name('submissions.submit');
    });

    // 4. Dynamic Template Engine Management (Admin Kecamatan & Bagian Hukum)
    Route::middleware(['role:admin_kecamatan|bagian_hukum'])->group(function () {
        Route::resource('templates', SkTemplateController::class);
    });

    // 5. Verification & Approval Workflow
    Route::prefix('verification')->name('verification.')->group(function () {

        // Tahap 2: Verifikasi Teknis Kecamatan
        Route::middleware(['role:admin_kecamatan'])->group(function () {
            Route::get('/kecamatan', [SkVerificationController::class, 'kecamatanIndex'])->name('kecamatan');
            Route::post('/{submission}/forward', [SkVerificationController::class, 'forwardToHukum'])->name('forward');
        });

        // Tahap 3: Penomoran Resmi Bagian Hukum (Setda)
        Route::middleware(['role:bagian_hukum'])->group(function () {
            Route::get('/hukum', [SkVerificationController::class, 'hukumIndex'])->name('hukum');
            Route::post('/{submission}/assign-number', [SkVerificationController::class, 'assignNumber'])->name('assign-number');
        });

        // Tahap 4: Pengesahan & TTE Camat
        Route::middleware(['role:camat'])->group(function () {
            Route::get('/camat', [SkVerificationController::class, 'camatIndex'])->name('camat');
            Route::post('/{submission}/approve', [SkVerificationController::class, 'approveCamat'])->name('approve');
        });

        // Kembalikan Revisi / Tolak (Kecamatan & Hukum)
        Route::middleware(['role:admin_kecamatan|bagian_hukum'])->group(function () {
            Route::post('/{submission}/revision', [SkVerificationController::class, 'returnRevision'])->name('revision');
        });
    });
});

require __DIR__ . '/auth.php';

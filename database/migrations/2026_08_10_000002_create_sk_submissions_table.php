<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sk_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_code')->unique(); // Contoh ID Lacak: SK-202608-0001
            $table->foreignId('template_id')->constrained('sk_templates')->onDelete('cascade');
            $table->foreignId('kelurahan_id')->constrained('users')->onDelete('cascade'); // ID User Admin Kelurahan
            $table->json('field_values'); // Key-Value pair input dari form dinamis

            $table->string('sk_number')->nullable(); // Diisi oleh Bagian Hukum (Setda)
            $table->enum('status', [
                'draft_kelurahan',
                'review_kecamatan',
                'review_hukum',
                'ready_for_approval',
                'approved',
                'rejected'
            ])->default('draft_kelurahan');

            $table->text('revision_notes')->nullable(); // Catatan revisi jika dikembalikan/ditolak
            $table->string('tte_hash')->nullable()->unique(); // Hash SHA-256 unik untuk TTE QR
            $table->foreignId('approved_by')->nullable()->constrained('users'); // ID Camat
            $table->timestamp('approved_at')->nullable();
            $table->string('final_pdf_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sk_submissions');
    }
};

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
        Schema::create('sk_templates', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Contoh: SK-TAKMIR, SK-RTRW
            $table->string('title'); // Contoh: SK Pengurus Takmir Masjid
            $table->text('html_template'); // Content HTML dengan placeholder {{nama_ketua}}, {{alamat_masjid}}
            $table->json('dynamic_fields'); // Schema JSON: [{"name":"nama_ketua", "label":"Nama Ketua", "type":"text"}]
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sk_templates');
    }
};

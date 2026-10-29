<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $columns = array_filter([
            Schema::hasColumn('sk_templates', 'template_type') ? 'template_type' : null,
            Schema::hasColumn('sk_templates', 'pdf_path') ? 'pdf_path' : null,
            Schema::hasColumn('sk_templates', 'pdf_fields') ? 'pdf_fields' : null,
        ]);

        if ($columns !== []) {
            Schema::table('sk_templates', function (Blueprint $table) use ($columns): void {
                $table->dropColumn($columns);
            });
        }
    }

    public function down(): void
    {
        Schema::table('sk_templates', function (Blueprint $table): void {
            $table->string('template_type')->default('html')->after('title');
            $table->string('pdf_path')->nullable()->after('html_template');
            $table->json('pdf_fields')->nullable()->after('dynamic_fields');
        });
    }
};

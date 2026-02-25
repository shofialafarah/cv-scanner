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
        Schema::table('candidates', function (Blueprint $table) {
            // 1. Buat dulu kolomnya (unsignedBigInteger agar cocok dengan ID tabel lain)
            $table->unsignedBigInteger('job_post_id')->after('id')->nullable();

            // 2. Definisikan foreign key-nya secara manual ke tabel 'job_posts'
            $table->foreign('job_post_id')
                ->references('id')
                ->on('job_posts')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->dropForeign(['job_post_id']);
            $table->dropColumn('job_post_id');
        });
    }
};

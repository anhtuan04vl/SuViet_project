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
        Schema::create('logo', function (Blueprint $table) {
            $table->id(); // Cột id tự tăng
            $table->string('img'); // Đường dẫn hoặc tên file ảnh
            $table->boolean('active')->default(false); // Trạng thái hoạt động
            $table->timestamps(); // Thêm created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logo');
    }
};

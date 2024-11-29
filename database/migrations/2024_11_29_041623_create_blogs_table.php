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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id('id_blog'); // Tạo trường id_blog, kiểu dữ liệu là integer tự tăng
            $table->string('images'); // Trường lưu ảnh, kiểu string
            $table->unsignedBigInteger('category_id'); // Liên kết với bảng categories
            $table->unsignedBigInteger('product_id'); // Liên kết với bảng products
            $table->unsignedBigInteger('users_id'); // Liên kết với bảng users
            $table->string('title'); // Trường lưu tiêu đề
            $table->text('description'); // Trường lưu mô tả
            $table->timestamps(); // Tạo các trường created_at và updated_at

            // Định nghĩa khóa ngoại
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('users_id')->references('users_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};

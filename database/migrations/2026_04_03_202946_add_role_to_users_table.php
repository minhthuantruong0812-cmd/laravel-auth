<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Thêm cột role: 0 là User thường (mặc định), 1 là Admin
            // Hàm after('password') giúp xếp cột role nằm ngay sau cột password cho gọn gàng
            $table->tinyInteger('role')->default(0)->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Xóa cột role trong trường hợp bạn muốn chạy lệnh rollback (hoàn tác)
            $table->dropColumn('role');
        });
    }
};
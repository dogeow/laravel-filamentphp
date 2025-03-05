<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migration.
     */
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('phone')->nullable()->comment('电话');
            $table->string('email')->nullable()->comment('邮箱');
            $table->string('address')->nullable()->comment('地址');
            $table->string('house_status')->nullable()->comment('房屋状态');
            $table->string('ip_address')->nullable()->comment('访问者IP');
            $table->string('message')->nullable()->comment('留言内容');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
}; 
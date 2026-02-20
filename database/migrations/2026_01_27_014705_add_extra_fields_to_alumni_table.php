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
        Schema::table('alumni', function (Blueprint $table) {
            $table->text('address')->after('pelatihan_id');
            $table->string('phone_number')->after('address');
            $table->string('company_name')->nullable()->after('employment_status');
            $table->string('position')->nullable()->after('company_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alumni', function (Blueprint $table) {
            $table->dropColumn(['address', 'phone_number', 'company_name', 'position']);
        });
    }
};

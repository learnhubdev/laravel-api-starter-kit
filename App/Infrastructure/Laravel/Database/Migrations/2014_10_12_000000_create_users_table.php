<?php

declare(strict_types=1);

use App\Domain\Members\StatusName;
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
        Schema::create(table: 'users', callback: function (Blueprint $table) {
            $table->snowflake()->primary();
            $table->string(column: 'first_name', length: 100);
            $table->string(column: 'last_name', length: 100);
            $table->string(column: 'email', length: 200)->unique();
            $table->timestamp(column: 'email_verified_at')->nullable();
            $table->string(column: 'password');
            $table->unsignedTinyInteger(column: 'status')->default(value: StatusName::PENDING->value);
            $table->string(column: 'remember_token', length: 100)->nullable();
            $table->timestamp(column: 'created_at')->nullable();
            $table->timestamp(column: 'updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'users');
    }
};

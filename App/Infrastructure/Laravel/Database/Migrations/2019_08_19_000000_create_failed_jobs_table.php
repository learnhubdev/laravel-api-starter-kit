<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(table: 'failed_jobs', callback: function (Blueprint $table) {
            $table->snowflake()->primary();
            $table->string(column: 'uuid')->unique();
            $table->text(column: 'connection');
            $table->text(column: 'queue');
            $table->longText(column: 'payload');
            $table->longText(column: 'exception');
            $table->timestamp(column: 'failed_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'failed_jobs');
    }
};

<?php

declare(strict_types=1);

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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid(column: 'resource_id')->unique();

            $table->string(column: 'first_name')->nullable();
            $table->string(column: 'last_name')->nullable();

            $table->string(column: 'avatar')->nullable();
            $table->string(column: 'status')->nullable()->default('Pending');

            $table->string(column: 'email')->unique();
            $table->string(column: 'password')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

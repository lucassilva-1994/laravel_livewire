<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private $table = 'users';
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->bigInteger('order');
            $table->string('name');
            $table->string('username',100)->unique();
            $table->string('email',100)->unique();
            $table->string('password',100);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('short_links', function (Blueprint $table) {
            $table->id();
            $table->string('hash')->unique();
            $table->text('url');
            $table->boolean('used')->default(false);
            $table->timestamp('created_at');
            $table->timestamp('expires_at');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomainsTable extends Migration
{
    public function up()
    {
        Schema::create('domains', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('host'); // example.com
            $table->string('label')->nullable(); // display name

            $table->boolean('is_active')->default(true);

            // settings
            $table->string('check_method', 8)->default('HEAD'); // HEAD | GET
            $table->unsignedInteger('check_interval_minutes')->default(5);
            $table->unsignedInteger('timeout_seconds')->default(10);

            $table->timestamp('last_checked_at')->nullable();

            $table->timestamps();

            $table->index(['user_id', 'is_active']);
            $table->unique(['user_id', 'host']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('domains');
    }
}


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomainChecksTable extends Migration
{
    public function up()
    {
        Schema::create('domain_checks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('domain_id')->constrained()->cascadeOnDelete();

            $table->timestamp('checked_at');
            $table->unsignedSmallInteger('status_code')->nullable();
            $table->boolean('is_success')->default(false);
            $table->unsignedInteger('response_time_ms')->nullable();
            $table->text('error_message')->nullable();

            $table->timestamps();

            $table->index(['domain_id', 'checked_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('domain_checks');
    }
}


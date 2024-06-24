<?php

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
        Schema::create('complaint_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('agent_id')->nullable();
            $table->integer('property_id')->nullable();
            $table->string('complaint_name')->nullable();
            $table->string('complaint_email')->nullable();
            $table->text('complaint')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complaint_forms');
    }
};

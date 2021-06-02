<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            // $table->integer('ticket_detail_id');
            $table->text('machine_description')->nullable();
            $table->text('cost_center_line')->nullable();
            $table->text('supervisor_name')->nullable();
            $table->text('description_of_problem')->nullable();
            $table->integer('priority_level')->nullable();
            $table->integer('status')->default('1');
            $table->integer('technician_id')->nullable();
            $table->text('request_id');
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
        Schema::dropIfExists('tickets');
    }
}

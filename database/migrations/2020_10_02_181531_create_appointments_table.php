<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('country');
            $table->string('city');
            $table->string('street');
            $table->string('house');
            $table->string('zip_code')->nullable();
            $table->string('asap')->nullable();
            $table->dateTime('specific_time')->nullable();
            $table->text('comment')->nullable();
            $table->boolean('is_favorite');
            $table->integer('price');


            $table->unsignedBigInteger('package_id')->nullable();
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('set null');
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('detailer_id')->nullable();
            $table->foreign('detailer_id')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');

            $table->unsignedBigInteger('status_detailer_id')->nullable();
            $table->foreign('status_detailer_id')->references('id')->on('statuses')->onDelete('cascade');

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
        Schema::dropIfExists('appointments');
    }
}

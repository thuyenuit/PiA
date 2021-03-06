<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fields', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('field_group_id');
            $table->string('locale_key');
            $table->integer('field_type')->default(0);
            $table->integer('sequence');
            $table->boolean('mandatory');
            $table->boolean('active')->default(true);
            $table->boolean('show_in_report')->default(true);
            $table->boolean('show_in_portal')->default(true);
            $table->text('setting')->nullable();
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
        Schema::dropIfExists('fields');
    }
}

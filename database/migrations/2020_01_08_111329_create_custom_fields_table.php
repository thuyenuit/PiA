<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('custom_field_group_id');
            $table->string('label_locale');
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
        Schema::dropIfExists('custom_fields');
    }
}

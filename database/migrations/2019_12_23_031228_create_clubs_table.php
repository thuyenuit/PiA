<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clubs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('aircraft_type')->nullable();
            $table->string('club_logo')->nullable();
            $table->string('region')->nullable();
            $table->string('address')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('town')->nullable();
            $table->string('email')->nullable();
            $table->string('internet')->nullable();

            $table->text('club_admin_ids')->nullable();
            $table->bigInteger('chef_instructor_id')->nullable();
            $table->text('club_contact_ids')->nullable();

            $table->boolean('charge_club_of_quota')->default(false);
            $table->bigInteger('monthly_payment')->nullable();
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
        Schema::dropIfExists('clubs');
    }
}

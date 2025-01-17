<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->string('member_id');
            $table->string('name');
            $table->string('username');
            $table->integer('total_contributions');

            $table->string('password');
            $table->string('email');
            $table->string('phone_number');
            $table->primary(['member_id']);
            $table->integer('previous_loan_performance');
            $table->integer('loan_progress')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('members');
    }
}

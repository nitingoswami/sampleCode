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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('req_id')->nullable();
            $table->string('filter_label')->nullable();
            $table->string('filter_value')->nullable();
            $table->string('ad_code')->nullable();
            $table->string('brand')->nullable();
            $table->string('campaign_code')->nullable();
            $table->string('category')->nullable();
            $table->string('city')->nullable();
            $table->string('client_customer')->nullable();
            $table->string('employer')->nullable();
            $table->string('country')->nullable();
            $table->string('custom_field_1')->nullable();
            $table->string('custom_field_2')->nullable();
            $table->string('custom_field_3')->nullable();
            $table->string('custom_field_4')->nullable();
            $table->string('custom_field_5')->nullable();
            $table->string('certification')->nullable();
            $table->string('degree')->nullable();
            $table->string('department')->nullable();
            $table->string('education')->nullable();
            $table->string('experience')->nullable();
            $table->string('job_type')->nullable();
            $table->string('job_level')->nullable();
            $table->text('location')->nullable();
            $table->text('url')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->text('multi_location')->nullable();
            $table->string('business_unit')->nullable();
            $table->string('facility')->nullable();
            $table->string('job_id')->nullable();
            $table->string('shift_type')->nullable();
            $table->string('compensation')->nullable();
            $table->string('recruiter_id')->nullable();
            $table->string('locale')->nullable();
            $table->string('travel')->nullable();
            $table->string('product_service')->nullable();
            $table->string('posted_date')->nullable();
            $table->text('segments')->nullable();
            $table->string('major_market')->nullable();
            $table->string('secondary_market')->nullable();
            $table->string('job_poster_email_address')->nullable();
            $table->string('contract_id')->nullable();
            $table->string('employer_id')->nullable();
            $table->string('industries')->nullable();
            $table->string('job_function')->nullable();
            $table->string('job_unique_id')->index();
            $table->string('is_remote')->nullable();
            $table->string('workplace_types')->nullable();
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
        Schema::dropIfExists('jobs');
    }
};

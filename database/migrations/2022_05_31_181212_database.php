<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Database extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('t_post');
        Schema::dropIfExists('t_commentPost');
        Schema::dropIfExists('t_order');
        Schema::dropIfExists('t_order_detail');
        Schema::dropIfExists('t_contact');
        Schema::dropIfExists('t_user');
        Schema::dropIfExists('t_category');
        Schema::dropIfExists('t_product');
        Schema::dropIfExists('t_product_inventory');
        Schema::dropIfExists('t_commentProduct');
        Schema::dropIfExists('t_user_favourite');

        Schema::create('t_post', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('m_id_user')->nullable();
            $table->string('m_title', 255);
            $table->string('m_slug', 255);
            $table->text('m_desc');
            $table->text('m_content');
            $table->integer('m_view')->default(0);
            $table->string('m_meta_desc', 255)->nullable();
            $table->string('m_meta_keyword', 255)->nullable();
            $table->boolean('m_status')->default(1);
            $table->string('m_image', 200);
            $table->timestamps();
            $table->foreign('m_id_user')->references('id')->on('t_user');
        });
        Schema::create('t_commentPost', function (Blueprint $table) {
            $table->increments('idbl');
            $table->unsignedInteger('m_id_post');
            $table->unsignedInteger('m_id_user');
            $table->integer('m_id_parent');
            $table->text('m_content');
            $table->string('answer_question')->nullable();
            $table->date('ngaybl')->nullable();
            $table->boolean('m_status')->default(0);
            $table->text('answer_cmt')->nullable();
            $table->timestamps();
            $table->foreign('m_id_post')->references('id')->on('t_post');
            $table->foreign('m_id_user')->references('id')->on('t_user');
        });
        Schema::create('t_order', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('m_id_user')->nullable();
            $table->string('m_name', 255);
            $table->string('m_email', 255);
            $table->string('m_address', 255);
            $table->string('m_phone', 15);
            $table->text('m_note')->nullable();
            $table->double('m_total_price');
            $table->integer('m_fee_ship');
            $table->integer('m_coupon')->nullable();
            $table->boolean('m_status_ship')->default(0);
            $table->boolean('m_status_pay')->default(0);
            $table->boolean('m_status')->default(0);
            $table->timestamps();
            $table->foreign('m_id_user')->references('id')->on('t_user');
        });
        Schema::create('t_order_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('m_id_order');
            $table->unsignedInteger('m_id_product');
            $table->double('m_price');
            $table->integer('m_quanti');
            $table->string('m_product_name', 255);
            $table->integer('m_size');
            $table->foreign('m_id_order')->references('id')->on('t_order');
            $table->foreign('m_id_product')->references('id')->on('t_product');
            $table->timestamps();
        });
        Schema::create('t_contact', function (Blueprint $table) {
            $table->increments('id');
            $table->string('m_name', 255);
            $table->string('m_phone', 15);
            $table->string('m_email', 255);
            $table->string('m_title', 255);
            $table->text('m_content')->nullable();
            $table->text('m_reply')->nullable();
            $table->timestamps();
        });
        Schema::create('t_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone', 15)->nullable();
            $table->boolean('role')->default(0);
            $table->boolean('multiple_role')->default(0);
            $table->string('m_address', 255)->nullable();
            $table->text('m_avatar')->nullable();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('m_status')->default(0);
            $table->text('m_token', 20)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('t_category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('m_id_parent');
            $table->string('m_title', 255);
            $table->integer('m_index')->default(0);
        });
        Schema::create('t_product', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('m_id_category');
            $table->string('m_product_name', 255);
            $table->string('m_product_slug', 255);
            $table->string('m_short_description', 255);
            $table->text('m_description');
            $table->text('m_picture');
            $table->double('m_price');
            $table->double('m_original_price');
            $table->integer('m_buy');
            $table->integer('m_view')->default(1);
            $table->boolean('m_status')->default(0);
            $table->timestamps();
            $table->foreign('m_id_category')->references('id')->on('t_category');
        });
        Schema::create('t_commentProduct', function (Blueprint $table) {
            $table->increments('idbl');
            $table->unsignedInteger('m_id_maloai');
            $table->unsignedInteger('m_id_user');
            $table->integer('m_id_parent');
            $table->integer('ratings');
            $table->text('m_content');
            $table->text('answer_cmt')->nullable();
            $table->boolean('m_status')->default(0);
            $table->date('ngaybinhluan')->nullable();
            $table->timestamps();
            $table->foreign('m_id_maloai')->references('id')->on('t_product');
            $table->foreign('m_id_user')->references('id')->on('t_user');
        });
        // table slider
        Schema::create('t_slider', function (Blueprint $table) {
            $table->increments('id');
            $table->text('m_images');
            $table->string('m_subtitle', 255);
            $table->string('m_title', 255);
            $table->string('m_description', 255);
            $table->string('m_link', 255);
            $table->boolean('m_status');
        });
        Schema::create('t_product_inventory', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('m_id_product');
            $table->integer('m_quanti');
            $table->string('m_size', 255);
            $table->foreign('m_id_product')->references('id')->on('t_product');
        });

        Schema::create('t_coupon', function (Blueprint $table) {
            $table->increments('id');
            $table->string('coupon_name', 150);
            $table->integer('coupon_time');
            $table->integer('coupon_method');
            $table->string('coupon_code', 50);
            $table->integer('coupon_value');
            $table->date('coupon_expired');
            $table->timestamps();
        });

        Schema::create('t_transport_fee', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('m_province_id');
            $table->integer('m_district_id');
            $table->integer('m_ward_id');
            $table->double('m_fee_ship');
        });

        Schema::create('t_user_favourite', function (Blueprint $table) {
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_product');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::enableForeignKeyConstraints();
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('barcode');
            $table->string('legacy_barcode')->nullable();
            $table->string('description');
            $table->string('supplier')->nullable();
            $table->string('brand')->nullable();
            $table->string('division')->nullable();
            $table->string('department')->nullable();
            $table->string('category')->nullable();
            $table->string('sub_category')->nullable();
            $table->string('status');
            $table->string('material')->nullable();
            $table->string('code')->nullable();
            $table->string('dimension')->nullable();
            $table->string('finish_color')->nullable();
            $table->text('feature')->nullable();
            $table->text('benefits')->nullable();
            $table->string('last_update_date');
            $table->string('last_update_by');
            // $table->string('ebs_msi_updated_by');
            // $table->string('ebs_msi_updated_at');
            // $table->string('ebs_ic_updated_at');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->unsignedBigInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
}

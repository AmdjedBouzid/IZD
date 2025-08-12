<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('metadata', function (Blueprint $table) {
            $table->id();
            $table->string('website_name');
            $table->string('website_logo_path');
            $table->string('huge_title');
            $table->text('description')->nullable();
            $table->string('font_color', 20)->default('#FFFFFF');
        });

        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
        
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image_path')->nullable();
        });
        
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('from');
            $table->string('object');
            $table->text('content');
            $table->timestamps();
        });
      
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->enum('platform', [
                'location',
                'phone',
                'email',
                'whatsapp',
                'telegram',
                'linkedin',
                'facebook',
                'instagram',
                'twitter',
                'website'
            ]);
            $table->string('value');
            $table->string('name');
        });

    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metadata');
        Schema::dropIfExists('companies');
        Schema::dropIfExists('services');
        Schema::dropIfExists('banners');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('contacts');
    }
};

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
        Schema::table('listings', function (Blueprint $table) {
            $table->string('mastodon')->after('blog_url')->nullable();
            $table->string('rss')->after('blog_url')->nullable();
            $table->string('bluesky_url')->after('blog_url')->nullable();
            $table->string('threads')->after('blog_url')->nullable();
            $table->string('whatsapp_community_url')->after('blog_url')->nullable();
            $table->string('telegram_community_url')->after('blog_url')->nullable();
            $table->string('discord_url')->after('blog_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('listings', function (Blueprint $table) {
            //
        });
    }
};

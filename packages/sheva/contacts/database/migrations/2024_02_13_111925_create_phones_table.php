<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('phones', function (Blueprint $table) {
            $table->uuid()->unique();
            $table->unsignedBigInteger('phone');
            $table->foreignIdFor(\Sheva\Contacts\Models\Employee::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    public function down()
    {
        if (!app()->isLocal()) {
            return;
        }
        Schema::dropIfExists('phones');
    }
};

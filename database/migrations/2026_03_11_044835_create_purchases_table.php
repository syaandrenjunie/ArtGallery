<?php

use App\Models\Artist;
use App\Models\Artwork;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Artist::class);
            $table->foreignIdFor(Artwork::class);
            $table->string('payment_method');
            $table->string('account_number');
            $table->string('payment_proof')->nullable();
            $table->enum('status', ['to_ship', 'to_deliver', 'delivered', 'completed', 'cancelled'])
                ->default('to_ship');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};

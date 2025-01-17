<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTrackEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('track_events', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('event_name', 255); // Event name
            $table->timestamps(); // Timestamps
        });

        // Insert initial data
        DB::table('track_events')->insert([
            ['event_name' => '100m'],
            ['event_name' => '200m'],
            ['event_name' => '400m'],
            ['event_name' => '800m'],
            ['event_name' => '1500m'],
            ['event_name' => '5000m'],
            ['event_name' => '10000m'],
            ['event_name' => '110m Hurdles'],
            ['event_name' => '400m Hurdles'],
            ['event_name' => '3000m Steeplechase'],
            ['event_name' => 'Long Jump'],
            ['event_name' => 'Triple Jump'],
            ['event_name' => 'High Jump'],
            ['event_name' => 'Pole Vault'],
            ['event_name' => 'Shot Put'],
            ['event_name' => 'Discus Throw'],
            ['event_name' => 'Hammer Throw'],
            ['event_name' => 'Javelin Throw'],
            ['event_name' => 'Decathlon'],
            ['event_name' => 'Heptathlon'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('track_events');
    }
}

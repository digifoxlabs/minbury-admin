<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (! Schema::hasTable('contact_shipping_addresses')) {
            Schema::create('contact_shipping_addresses', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('contact_id');
                $table->string('label')->nullable();
                $table->text('shipping_address');
                $table->string('position')->nullable();
                $table->boolean('is_default')->default(false);
                $table->unsignedInteger('sort_order')->default(0);
                $table->timestamps();

                $table->foreign('contact_id')
                    ->references('id')
                    ->on('contacts')
                    ->onDelete('cascade');
            });
        }

        $contacts = DB::table('contacts')
            ->whereNotNull('shipping_address')
            ->where('shipping_address', '!=', '')
            ->select('id', 'shipping_address', 'position')
            ->get();

        $timestamp = now();
        $rows = [];
        $existing_contact_ids = DB::table('contact_shipping_addresses')
            ->select('contact_id')
            ->distinct()
            ->pluck('contact_id')
            ->all();

        foreach ($contacts as $contact) {
            if (in_array($contact->id, $existing_contact_ids)) {
                continue;
            }

            $rows[] = [
                'contact_id' => $contact->id,
                'label' => 'Default',
                'shipping_address' => $contact->shipping_address,
                'position' => $contact->position,
                'is_default' => true,
                'sort_order' => 0,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];
        }

        if (! empty($rows)) {
            DB::table('contact_shipping_addresses')->insert($rows);
        }
    }

    public function down()
    {
        Schema::dropIfExists('contact_shipping_addresses');
    }
};

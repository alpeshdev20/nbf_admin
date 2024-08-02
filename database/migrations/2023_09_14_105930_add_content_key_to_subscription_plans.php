<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContentKeyToSubscriptionPlans extends Migration
{
    public function up()
    {
        $records = DB::table('subscription_plans')->get();
        foreach ($records as $record) {
            $uniqueCode = $this->generateUniqueSubscriptionCode();
            DB::table('subscription_plans')
                ->where('id', $record->id)
                ->update(['content_key' => $uniqueCode]);
        }
    }

    public function down()
    {
       //
    }

    private function generateUniqueSubscriptionCode()
    {
        $code = strtoupper(Str::random(6));
        return $code;
    }
}

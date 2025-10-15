<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SessionsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sessions')->insert([
            [
                'id' => Str::uuid()->toString(),
                'user_id' => 1,
                'ip_address' => '192.168.1.10',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'payload' => base64_encode('{"example":"session data"}'),
                'last_activity' => time(),
            ],
            [
                'id' => Str::uuid()->toString(),
                'user_id' => 2,
                'ip_address' => '192.168.1.20',
                'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7)',
                'payload' => base64_encode('{"cart":"empty"}'),
                'last_activity' => time(),
            ],
        ]);
    }
}

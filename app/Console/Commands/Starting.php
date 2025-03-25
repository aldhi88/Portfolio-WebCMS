<?php

namespace App\Console\Commands;

use App\Models\Attribute;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Hash;

class Starting extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $faker = Container::getInstance()->make(Generator::class);
        $dtUser = [
            [
                'id' => 1,
                'username' => 'admin',
                'email' => $faker->unique()->safeEmail(),
                'first_name' => "Admin",
                'last_name' => "Website",
                'password' => Hash::make('admin'), // pass
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];
        User::insertOrIgnore($dtUser);
        // -----------------------
        $dtSetting = [
            [
                'id' => 1,
                'key' => 'max_file_upload',
                'value' => 2048,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];
        Setting::insertOrIgnore($dtSetting);
        // -----------------------
        $ary = ['address','location','email','phone','video','instagram','facebook','youtube','chat1','chat2','chat3','mail1','mail2','mail3','twitter'];
        foreach ($ary as $key => $value) {
            $dt[] = [
                'key' => $value,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        Attribute::insertOrIgnore($dt);unset($dt);
    }
}

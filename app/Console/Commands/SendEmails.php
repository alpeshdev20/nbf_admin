<?php

namespace App\Console\Commands;

use App\Models\TeacherDetail;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\EmailHelper;
use DB;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to existing teachers';

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
     * @return mixed
     */
    public function handle()
    {
        $customPass = Str::random(8);
        $subject = 'Your NetbookFlix password';
        $emails = TeacherDetail::pluck('email','teacher_name');
      
        foreach ($emails as $name => $email) {
            DB::table('admlogin')->where('email',$email)->update([
                'password' => Hash::make($customPass),
            ]);
            DB::table('u_logins')->where('email',$email)->update([
                'password' => Hash::make($customPass),
            ]);
            $message = '<p>Hello ' . $name  . ', <br /><br /> Your account has been created successfully with the password.<br /><br />
            Password: ' . $customPass . '
            <br /><br />
            Regards, <br /> Netbookflix
            </p>';
            EmailHelper::sendEmail($email, $subject, $message);
        }
    }
}

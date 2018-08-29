<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateMailConfigRequest;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class MailSetupController extends Controller
{
    public function view()
    {
        if (Auth::check() && Auth::user()->is_superuser)
        {
            return view('pages.mail_setup', [
                'driver' => config('mail.driver'),
                'host' => config('mail.host'),
                'port' => config('mail.port'),
                'username' => config('mail.username'),
                'password' => config('mail.password'),
                'encryption' => config('mail.encryption'),
            ]);
        }

        return redirect()->back();
    }

    public function update(UpdateMailConfigRequest $request)
    {
        $this->updateDotEnv('mail.driver', 'MAIL_DRIVER', $request->driver);
        $this->updateDotEnv('mail.host', 'MAIL_HOST', $request->host);
        $this->updateDotEnv('mail.port', 'MAIL_PORT', $request->port);
        $this->updateDotEnv('mail.username', 'MAIL_USERNAME', $request->username);
        $this->updateDotEnv('mail.password', '', $request->password);
        $this->updateDotEnv('mail.encryption', 'MAIL_ENCRYPTION', $request->encryption);

        Artisan::call('config:cache');

        return redirect()->back();
    }

    private function updateDotEnv($configKey, $envKey, $newValue, $delim='')
    {
        $path = base_path('.env');
        $oldValue = config($configKey);

        if (file_exists($path))
        {
            file_put_contents(
                $path, str_replace(
                    $envKey.'='.$delim.$oldValue.$delim,
                    $envKey.'='.$delim.$newValue.$delim,
                    file_get_contents($path)
                )
            );
        }
    }
}

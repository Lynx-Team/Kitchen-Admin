<?php
/**
 * Created by PhpStorm.
 * User: keltar
 * Date: 03.09.18
 * Time: 22:55
 */

namespace App\Http\Controllers;


use App\HistoryOrderList;
use App\Http\Requests\DaysIntervalRequest;
use App\Http\Requests\UpdateDaysToKeepRequest;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class HistoryOrderListController extends Controller
{
    public function view($kitchen_id)
    {
        if (Auth::check() && Auth::user()->can('view', HistoryOrderList::class))
            return view('pages.reporting', [
                'days_to_keep' => config('app.reporting.days_to_keep'),
                'reports' => HistoryOrderList::where('kitchen_id', $kitchen_id)->get()
            ]);
        return redirect()->back();
    }

    public function view_interval(DaysIntervalRequest $request, $kitchen_id)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // TODO: make interval SQL request
        return view('pages.reporting', [
            'days_to_keep' => config('app.reporting.days_to_keep'),
            'reports' => HistoryOrderList::where('kitchen_id', $kitchen_id)->get()
        ]);
    }

    public function update_days_to_keep(UpdateDaysToKeepRequest $request)
    {
        $this->updateDotEnv('app.reporting.days_to_keep', 'DAYS_TO_KEEP', $request->days_to_keep);
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
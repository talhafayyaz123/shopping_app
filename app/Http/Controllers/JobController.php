<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FailedJobs;
use Yajra\DataTables\DataTables;
use Response;
use Carbon\Carbon;

class JobController extends Controller
{
    public function index(Request $request)
{
    try {

        if ($request->ajax()) {
        
            $query = FailedJobs::query();
         
            return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('payload', function (FailedJobs $job) {


     
       $job_details = json_decode($job->payload);
            $job = ( unserialize($job_details->data->command));
            $resposne = '';
            foreach($job->getDetails() as $key => $val){
              if(!empty($val))
              $resposne .= "$key=$val, ";
            }
           return $resposne;

                
            })
            ->addColumn('exception', function (FailedJobs $job) {
                return  substr(implode('\n',explode("\n", $job->exception)) , 0,420);
            })
            ->addColumn('failed_at', function (FailedJobs $job) {
                return Carbon::parse($job->failed_at)->format('Y-m-d');
                
            })
           
            ->addColumn('action', function(FailedJobs $job){
                   
                  $btn =' <a href="job/retry/'.$job->uuid.'"" class="edit btn btn-primary btn-sm edit_button" ><i class="fa fa-arrow-right" aria-hidden="true"></i></a>';
            return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);

          
        }

        return view('admin.jobs.index');


    }catch (\Exception $exception){
        dd($exception->getMessage(),$exception->getFile(), $exception->getLine());
    }

    }
}

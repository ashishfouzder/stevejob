<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{ 
    public function candidates()
    {
        $users = DB::select('select * from candidates');

        echo '{"candidates_info":[';
        foreach ($users as $CandidatesData)
        {
            echo $CandidatesData->personal_details;
        }
        echo "]}";

    }
    public function employer_application()
    {
        $jsonData = file_get_contents('php://input');
        $post = json_decode(file_get_contents('php://input'), TRUE);

        date_default_timezone_set('Asia/Dhaka');
        $date=date('Y-m-d', strtotime('-0 day'));
        $time=date('H:i:s', strtotime('-0 day'));

        if($jsonData=="")
        {
            $result=array(
                'result'=>'invalid request'
            );
            echo json_encode($result);
        }
        else
        {
            $ApplicationData=array(
                'employer_id'=>$post['employer_id'],
                'title'=>$post['title'],
                'vacancy'=>$post['vacancy'],
                'job_responsibilities'=>$post['job_responsibilities'],
                'employment_status'=>$post['employment_status'],
                'workplace'=>$post['workplace'],
                'educational_requirements'=>$post['educational_requirements'],
                'experience_requirements'=>$post['experience_requirements'],
                'additional_requirements'=>$post['additional_requirements'],
                'job_location'=>$post['job_location'],
                'salary'=>$post['salary'],
                'compensation_benefits'=>$post['compensation_and_other_benefits'],
                'd_date'=>$date,
                'd_time'=>$time,
                'status'=>0,
            );

            DB::table('stevejob_employer_application')->insert($ApplicationData);

            $result=array(
                'result'=>'successful'
            );
            echo json_encode($result, JSON_UNESCAPED_SLASHES);
        }

    }

    public function employer_application_list()
    {
        date_default_timezone_set('Asia/Dhaka');
        $date=date('Y-m-d', strtotime('-0 day'));
        $time=date('H:i:s', strtotime('-0 day'));

        $Application = DB::select('select * from stevejob_employer_application ORDER BY id DESC LIMIT 1,20');

        echo '{"employer_application":[';

        foreach ($Application as $ApplicationData)
        {
            $EmployerApplication=array(
                'application_id'=>$ApplicationData->id,
                'employer_id'=>$ApplicationData->employer_id,
                'title'=>$ApplicationData->title,
                'vacancy'=>$ApplicationData->vacancy,
                'job_responsibilities'=>$ApplicationData->job_responsibilities,
                'employment_status'=>$ApplicationData->employment_status,
                'workplace'=>$ApplicationData->workplace,
                'educational_requirements'=>$ApplicationData->educational_requirements,
                'experience_requirements'=>$ApplicationData->experience_requirements,
                'additional_requirements'=>$ApplicationData->additional_requirements,
                'job_location'=>$ApplicationData->job_location,
                'salary'=>$ApplicationData->salary,
                'compensation_benefits'=>$ApplicationData->compensation_benefits,
                'date'=>$ApplicationData->d_date,
                'time'=>$ApplicationData->d_time,
                'status'=>$ApplicationData->status,
            );
            echo json_encode($EmployerApplication, JSON_UNESCAPED_SLASHES), ','."\n";

        }

        $Application2 = DB::select('select * from stevejob_employer_application ORDER BY id DESC LIMIT 0,1');


        foreach ($Application2 as $Application2Data)
        {
            $EmployerApplication=array(
                'application_id'=>$Application2Data->id,
                'employer_id'=>$Application2Data->employer_id,
                'title'=>$Application2Data->title,
                'vacancy'=>$Application2Data->vacancy,
                'job_responsibilities'=>$Application2Data->job_responsibilities,
                'employment_status'=>$Application2Data->employment_status,
                'workplace'=>$Application2Data->workplace,
                'educational_requirements'=>$Application2Data->educational_requirements,
                'experience_requirements'=>$Application2Data->experience_requirements,
                'additional_requirements'=>$Application2Data->additional_requirements,
                'job_location'=>$Application2Data->job_location,
                'salary'=>$Application2Data->salary,
                'compensation_benefits'=>$Application2Data->compensation_benefits,
                'date'=>$Application2Data->d_date,
                'time'=>$Application2Data->d_time,
                'status'=>$Application2Data->status,
            );
            echo json_encode($EmployerApplication, JSON_UNESCAPED_SLASHES);

        }
        echo "]}"; 
    }

    public function employer_application_delete()
    {
        $jsonData = file_get_contents('php://input');
        $post = json_decode(file_get_contents('php://input'), TRUE);

        date_default_timezone_set('Asia/Dhaka');
        $date=date('Y-m-d', strtotime('-0 day'));

        if($jsonData=="")
        {
            $result=array(
                'result'=>'invalid request'
            );
            echo json_encode($result);
        }
        else
        {
            $application_id=$post['application_id'];
            $employer_id=$post['employer_id'];
            DB::table('stevejob_employer_application')->where('id', $application_id AND 'employer_id', $employer_id)->delete();

            $PreviewData=array(
                'result'=>"success",
            );
            echo  json_encode($PreviewData, JSON_UNESCAPED_SLASHES);
        }

    }

    public function employer_application_edit()
    { 
        $jsonData = file_get_contents('php://input');
        $post = json_decode(file_get_contents('php://input'), TRUE);

        date_default_timezone_set('Asia/Dhaka');
        $date=date('Y-m-d', strtotime('-0 day'));
        $time=date('H:i:s', strtotime('-0 day'));

        if($jsonData=="")
        {
            $result=array(
                'result'=>'invalid request'
            );
            echo json_encode($result);
        }
        else
        {
            $application_id=$post['application_id'];
            $employer_id=$post['employer_id'];
            $title=$post['title'];
            $vacancy=$post['vacancy'];
            $job_responsibilities=$post['job_responsibilities'];
            $employment_status=$post['employment_status'];
            $workplace=$post['workplace'];
            $educational_requirements=$post['educational_requirements'];
            $experience_requirements=$post['experience_requirements'];
            $additional_requirements=$post['additional_requirements'];
            $job_location=$post['job_location'];
            $salary=$post['salary'];
            $compensation_and_other_benefits=$post['compensation_and_other_benefits'];

            DB::table('stevejob_employer_application')
            ->where('id', $application_id)
            ->where('employer_id', $employer_id)
            ->update(['title' => $title, 'vacancy' => $vacancy, 'job_responsibilities' => $job_responsibilities, 'employment_status' => $employment_status, 'workplace' => $workplace, 'educational_requirements' => $educational_requirements, 'experience_requirements' => $experience_requirements, 'additional_requirements' => $additional_requirements, 'job_location' => $job_location, 'salary' => $salary, 'compensation_benefits' => $compensation_and_other_benefits]);
            
            $PreviewData=array(
                'result'=>"success",
            );
            echo  json_encode($PreviewData, JSON_UNESCAPED_SLASHES);
        
        }

    }


}

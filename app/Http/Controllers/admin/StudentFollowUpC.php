<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AsignLeads;
use App\Models\Student;
use App\Models\StudentFollowUp;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StudentFollowUpC extends Controller
{
    public function addFollowup(Request $request)
    {
        //echo "hello " . $request['student_id'];
        // printArray($request->all());
        // die;
        $field = new StudentFollowUp();
        $field->user_id = $request['user_id'];
        $field->student_id = $request['student_id'];
        $field->lead_status = $request['lead_status'];
        $field->lead_sub_status = $request['lead_sub_status'];
        $field->next_followup_date = $request['next_followup_date'];
        $field->followup_type = $request['followup_type'];
        $field->followup_status = $request['followup_status'];
        $field->remark = $request['remark'];
        $field->comment = $request['comment'];
        $res = $field->save();
        if ($res) {
            $student = Student::find($request['student_id']);
            $student->lead_status = $request['lead_status'];
            $student->lead_sub_status = $request['lead_sub_status'];
            return $student->save();
        }
    }
    public function getLastFollowUp(Request $request)
    {
        $row = Student::where('id', $request->student_id)->with('getLastFup')->first();
        $output = '';
        $output .= '<small><span class="text-danger" title="' . $row->getLastFup->getUser->name . '"><b>' . Str::limit($row->getLastFup->getUser->name, 5) . '</b></span><span class="float-right">' . getFormattedDate($row->getLastFup->created_at, 'd M Y | h:i A') . '</span></small><hr  class="chr"><span class="text-info">' . $row->getLastFup->getLS->title . ' | ' . $row->getLastFup->getLSS->sub_status . '</span><hr class="chr"><b>' . getFormattedDate($row->getLastFup->next_followup_date, 'd M Y') . '</b>';

        if ($row->getLastFup->followup_type != '' && $row->getLastFup->followup_status != '') {
            $output .= '<br><span class="text-info">' . $row->getLastFup->followup_type . ' | ' . $row->getLastFup->followup_status . '</span><br>';
        }

        $output .= '<p style="width:200px">' . $row->getLastFup->remark . '</p><hr class="chr"><p style="width:200px">' . $row->getLastFup->comment . '</p><hr class="chr">';

        echo $output;
    }
    public function getAllFollowUp(Request $request)
    {
        $rows = StudentFollowUp::where('student_id', $request->student_id)->with('getUser', 'getLS', 'getLSS')->orderBy('id', 'desc')->get();
        $output = '';
        foreach ($rows as $row) {
            $output .= '<span class="timeline-label">
                  <span class="badge badge-pill badge-primary badge-lg">' . $row->getUser->name . '</span>
                </span>
                <div class="timeline-item">
                  <div class="timeline-point">
                    <i class="fa fa-star"></i>
                  </div>
                  <div class="timeline-event">
                    <div class="timeline-heading">
                      <h4 class="timeline-title"><b class="text-danger">' . $row->getLS->title . '</b> | <b class="text-danger">' . $row->getLSS->sub_status . '</b></h4>
                    </div>
                    <div class="timeline-body">
                      Next Follow-up to <b class="text-info">' . getFormattedDate($row->next_followup_date, 'd M Y') . '</b>
                      <br>';
            if ($row->followup_type != '' && $row->followup_status != '') {
                $output .= '<span class="text-info">' . $row->followup_type . ' | ' . $row->followup_status . '</span>
                      <br>';
            }
            if ($row->remark != '') {
                $output .= '<p class="just">' . $row->remark . '</p>
                      <hr>';
            }
            if ($row->comment != '') {
                $output .= '<p class="just">' . $row->comment . '</p>';
            }
            $output .= '</div>
                    <div class="timeline-footer">
                      <p class="text-right">' . getFormattedDate($row->created_at, 'd M Y - h:i A') . '</p>
                    </div>
                  </div>
                </div>';
        }
        echo $output;
    }
    public function asignLeads(Request $request)
    {
        //echo "hello " . $request['student_id'];
        // printArray($request->all());
        // die;
        $student_id = $request['ids'];
        $tr = count($student_id);
        $ir = 0;
        for ($i = 0; $i < count($student_id); $i++) {
            $cal = AsignLeads::where(['user_id' => $request['user_id'], 'student_id' => $student_id[$i]])->count();
            if ($cal == 0) {
                $field = new AsignLeads;
                $field->user_id = $request['user_id'];
                $field->student_id = $student_id[$i];
                $field->save();
                $ir++;
            }
        }
        echo $ir;
    }
    public function unAsignLeads(Request $request)
    {
        $student_id = $request['student_id'];
        $td = 0;
        for ($i = 0; $i < count($student_id); $i++) {
            $where = ['user_id' => $request['user_id'], 'student_id' => $student_id[$i]];
            $result = AsignLeads::where($where)->delete();
            if ($result) {
                $td++;
            }
        }
        session()->flash('smsg', $td . ' leads unasigned succesfully.');
        echo $td;
    }
}

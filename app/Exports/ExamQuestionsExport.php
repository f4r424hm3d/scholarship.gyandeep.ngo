<?php

namespace App\Exports;

use App\Models\ExamQuestions;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExamQuestionsExport implements FromQuery,WithHeadings
{

    use Exportable;

    public function __construct(int $exam_id)
    {
        $this->exam_id = $exam_id;
    }

    public function headings():array{
        return[
            'subject_id',
            'question',
            'a',
            'b',
            'c',
            'd',
            'answer',
            'illustration',
            'direction',
            'image'
        ];
    }
    public function query()
    {
        return ExamQuestions::query()->select('subject_id','question','a','b','c','d','answer','illustration','direction','image')->where('exam_id', $this->exam_id);
    }
}

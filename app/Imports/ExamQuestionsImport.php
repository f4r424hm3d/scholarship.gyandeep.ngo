<?php

namespace App\Imports;

use App\Models\ExamQuestions;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ExamQuestionsImport implements ToCollection, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function __construct(string $exam_id)
    {
        $this->exam_id = $exam_id;
    }
    public function startRow(): int
    {
        return 2;
    }
    public function collection(collection $rows)
    {
        $rowsInserted = 0;
        $totalRows = 0;
        foreach ($rows as $row) {
            $where = [
                'exam_id' => $this->exam_id,
                'subject_id' => $row['subject_id'],
                'question' => $row['question']
            ];
            $data = ExamQuestions::where($where)->count();
            //if ($data==0) {
                ExamQuestions::create([
                    'exam_id' => $this->exam_id,
                    'subject_id' => $row['subject_id'],
                    'question' => $row['question'],
                    'a' => $row['a'],
                    'b' => $row['b'],
                    'c' => $row['c'],
                    'd' => $row['d'],
                    'answer' => $row['answer'],
                    'illustration' => $row['illustration'],
                    'direction' => $row['direction'],
                    'image' => $row['image'],
                ]);
                $rowsInserted++;
            //}
            $totalRows++;
        }
        if ($rowsInserted > 0) {
            session()->flash('smsg', $rowsInserted . ' out of ' . $totalRows . ' rows imported succesfully.');
        } else {
            session()->flash('emsg', 'Data not imported. Duplicate rows found.');
        }
    }

    public function chunkSize(): int
    {
        return 1000;
    }
    public function batchSize(): int
    {
        return 1000;
    }
}

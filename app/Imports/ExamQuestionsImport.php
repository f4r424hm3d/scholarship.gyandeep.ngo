<?php

namespace App\Imports;

use App\Models\ExamQuestions;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ExamQuestionsImport implements ToCollection, WithHeadingRow, WithChunkReading, WithBatchInserts
{
  private $exam_id;

  public function __construct(string $exam_id)
  {
    $this->exam_id = $exam_id;
  }

  public function collection(Collection $rows)
  {
    $rowsInserted = 0;
    $totalRows = 0;

    foreach ($rows as $index => $row) {
      $totalRows++;

      try {
        $where = [
          'exam_id' => $this->exam_id,
          'subject_id' => $row['subject_id'],
          'question' => $row['question'],
        ];

        $exists = ExamQuestions::where($where)->exists();

        if (!$exists) {
          ExamQuestions::create([
            'exam_id' => $this->exam_id,
            'subject_id' => $row['subject_id'],
            'question' => $row['question'],
            'a' => $row['a'],
            'b' => $row['b'],
            'c' => $row['c'],
            'd' => $row['d'],
            'answer' => $row['answer'],
            'illustration' => $row['illustration'] ?? null,
            'direction' => $row['direction'] ?? null,
            'image' => $row['image'] ?? null,
          ]);

          $rowsInserted++;
        }
      } catch (\Exception $e) {
        Log::error("Row " . ($index + 2) . " failed: " . $e->getMessage());
        continue;
      }
    }

    if ($rowsInserted > 0) {
      session()->flash('smsg', "$rowsInserted out of $totalRows rows imported successfully.");
    } else {
      session()->flash('emsg', "Data not imported. All rows were duplicates or invalid.");
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

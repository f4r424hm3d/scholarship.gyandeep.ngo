<?php

namespace App\Imports;

use App\Models\Specialization;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SpecializationImport implements ToCollection, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function startRow(): int
    {
        return 2;
    }
    public function collection(Collection $rows)
    {
        $rowsInserted = 0;
        $totalRows = 0;
        foreach ($rows as $row) {
            $data = Specialization::where('category_id', '=', $row['category_id'])->where('specialization', '=', $row['specialization'])->first();
            if (empty($data)) {
                Specialization::create([
                    'category_id' => $row['category_id'],
                    'specialization' => $row['specialization'],
                    'specialization_slug' => slugify($row['specialization']),
                    'status' => '1',
                ]);
                $rowsInserted++;
            }
            $totalRows++;
        }
        if ($rowsInserted > 0) {
            session()->flash('smsg', $rowsInserted . ' out of ' . $totalRows . ' rows imported succesfully.');
        } else {
            session()->flash('emsg', 'Data not imported. Duplicate rows found.');
        }
    }
    // public function model(array $row)
    // {
    //     //dd($row);
    //     $data = Specialization::where('category_id', '=', $row['category_id'])->where('specialization', '=', $row['specialization'])->first();
    //     printArray($data);
    //     if (empty($data)) {
    //         return new Specialization([
    //             'category_id' => $row['category_id'],
    //             'specialization' => $row['specialization'],
    //             'specialization_slug' => slugify($row['specialization']),
    //             'status' => '1'
    //         ]);
    //     }
    // }
    public function chunkSize(): int
    {
        return 1000;
    }
    public function batchSize(): int
    {
        return 1000;
    }
}

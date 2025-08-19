<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Layout;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ExportController extends Controller
{
  public function exportStudentChart()
  {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Sample data - replace with actual student data
    $data = [
      ['Name', 'Attempted', 'Correct', 'Accuracy (%)'],
      ['Ali', 20, 15, 75],
      ['Sara', 25, 20, 80],
      ['John', 30, 25, 83.33],
    ];

    // Add data to worksheet
    $sheet->fromArray($data, null, 'A1');

    // Define labels for the chart (Attempted, Correct, Accuracy)
    $labels = [
      new DataSeriesValues('String', 'Worksheet!$B$1', null, 1),
      new DataSeriesValues('String', 'Worksheet!$C$1', null, 1),
      new DataSeriesValues('String', 'Worksheet!$D$1', null, 1),
    ];

    // Define X-axis categories (Names)
    $categories = [
      new DataSeriesValues('String', 'Worksheet!$A$2:$A$4', null, 3),
    ];

    // Define data values for each series
    $values = [
      new DataSeriesValues('Number', 'Worksheet!$B$2:$B$4', null, 3),
      new DataSeriesValues('Number', 'Worksheet!$C$2:$C$4', null, 3),
      new DataSeriesValues('Number', 'Worksheet!$D$2:$D$4', null, 3),
    ];

    // Build the data series for the chart
    $series = new DataSeries(
      DataSeries::TYPE_PIECHART,       // chart type
      DataSeries::GROUPING_CLUSTERED,  // grouping
      range(0, count($values) - 1),    // plot order
      $labels,                         // labels
      $categories,                     // X-axis categories
      $values                         // data values
    );

    // Set chart layout and plot area
    $layout = new Layout();
    $plotArea = new PlotArea($layout, [$series]);

    // Set legend position
    $legend = new Legend(Legend::POSITION_RIGHT, null, false);

    // Chart title
    $title = new Title('Student Exam Performance');

    // Create the chart
    $chart = new Chart('Student Chart', $title, $legend, $plotArea);

    // Set chart position in worksheet
    $chart->setTopLeftPosition('F2');
    $chart->setBottomRightPosition('L16');

    // Add the chart to the worksheet
    $sheet->addChart($chart);

    // Prepare writer and output
    $writer = new Xlsx($spreadsheet);
    $writer->setIncludeCharts(true);

    $filename = 'students_performance_chart.xlsx';

    // Save the file to a temporary location
    $temp_file = tempnam(sys_get_temp_dir(), $filename);
    $writer->save($temp_file);

    // Return response to download the file and delete after sending
    return response()->download($temp_file, $filename)->deleteFileAfterSend(true);
  }
}

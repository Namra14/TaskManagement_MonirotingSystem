<?php

require '../../user-logged/recommendations/vendor/autoload.php';

include '../config.php';

use Rubix\ML\Datasets\Labeled;
use Rubix\ML\Classifiers\KNearestNeighbors;
use Rubix\ML\Datasets\Unlabeled;
use Rubix\ML\CrossValidation\HoldOut;
use Rubix\ML\CrossValidation\Metrics\Accuracy;
use League\Csv\Reader;

$query = mysqli_query($conn, "SELECT * FROM `grades_dataset` WHERE id='1'");
$row = mysqli_fetch_assoc($query);

$dataset = $row['dataset_name'];

$csv = Reader::createFromPath('../../admin/dataset/' . $dataset , 'r');
$csv->setHeaderOffset(0);

$dataset = [];

foreach ($csv as $record) {
    // Assuming your CSV has columns named 'Feature1', 'Feature2', ... 'Label'
    $sample = array_slice($record, 0, -1); // Exclude the last column (label)
    $label = end($record); // Get the last column (label)

    $dataset['samples'][] = array_map('floatval', $sample);
    $dataset['labels'][] = $label;
}

$samples = $dataset['samples'];
$labels = $dataset['labels'];

$dataset = new Labeled($samples, $labels);

$estimator = new KNearestNeighbors(3);
$estimator->train($dataset);
#var_dump($estimator->trained());


//Unlabeled Sample for prediction
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the form submission
    $u_samples = [
        [
            'ITEC102' => floatval($_POST['ITEC102']),
            'ITEC103' => floatval($_POST['ITEC103']),
            'ITEC205' => floatval($_POST['ITEC205']),
            'ITEL201' => floatval($_POST['ITEL201']),
            'ITEC204' => floatval($_POST['ITEC204']),
            'ITEP204' => floatval($_POST['ITEP204']),
            'GEC106' => floatval($_POST['GEC106']),
            'ITEP205' => floatval($_POST['ITEP205']),
            'ITEL203' => floatval($_POST['ITEL203']),
            'GEC108' => floatval($_POST['GEC108']),
            'ITEP203' => floatval($_POST['ITEP203']),
            'ITEP207' => floatval($_POST['ITEP207']),
        ],
    ];

    $u_dataset = new Unlabeled($u_samples);

    $estimator = new KNearestNeighbors(3);
    $estimator->train($dataset);

    $predictions = $estimator->predict($u_dataset);


    $itec102 = floatval($_POST['ITEC102']);
    $itec103 = floatval($_POST['ITEC103']);
    $itec205 = floatval($_POST['ITEC205']);
    $itel201 = floatval($_POST['ITEL201']);
    $itec204 = floatval($_POST['ITEC204']);
    $itep204 = floatval($_POST['ITEP204']);
    $gec106 = floatval($_POST['GEC106']);
    $itep205 = floatval($_POST['ITEP205']);
    $itel203 = floatval($_POST['ITEL203']);
    $gec108 = floatval($_POST['GEC108']);
    $itep203 = floatval($_POST['ITEP203']);
    $itep207 = floatval($_POST['ITEP207']);

    $update_query = mysqli_query($conn, " UPDATE `students_acc` 
                                                          SET 
                                                          itec102='$itec102', itec103='$itec103', itec205='$itec205', itel201='$itel201', 
                                                          itec204='$itec204', itep204='$itep204', gec106='$gec106', itep205='$itep205', 
                                                          itel203='$itel203', gec108='$gec108', itep203='$itep203', itep207='$itep207', 
                                                          grade_based='$predictions[0]' 
                                                          WHERE 
                                                          students_acc.userid='$session_id'");
    if ($update_query) {
        $_SESSION['message'] = "<script>alert('Database updated successfully!')</script>";
    } else  $_SESSION['message'] = "<script>alert('Database update failed!')</script>";
} else {
    // Initialize with default values
    $u_samples = [
        [
            'ITEC102' => 0,
            'ITEC103' => 0,
            'ITEC205' => 0,
            'ITEL201' => 0,
            'ITEC204' => 0,
            'ITEP204' => 0,
            'GEC106' => 0,
            'ITEP205' => 0,
            'ITEL203' => 0,
            'GEC108' => 0,
            'ITEP203' => 0,
            'ITEP207' => 0,
        ],
    ];
}

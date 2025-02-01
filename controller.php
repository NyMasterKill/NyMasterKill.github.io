<?php
require 'operations.php';

$result = '';
$error = '';
$sequenceResult = '';
$digitsResult = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['calculate'])) {
        $n = isset($_POST['sequence_n']) ? intval($_POST['sequence_n']) : '';

        if (is_int($n) && $n > 0) {
            $sequenceResult = calculateSequence($n);
        } else {
            $error = "Пожалуйста, введите целое положительное число для n.";
        }
    }

    if (isset($_POST['calculate_operation'])) {
        $num1 = isset($_POST['num1']) ? floatval($_POST['num1']) : '';
        $num2 = isset($_POST['num2']) ? floatval($_POST['num2']) : '';
        $operation = isset($_POST['operation']) ? $_POST['operation'] : '';

        if (is_numeric($num1) && is_numeric($num2) && $operation) {
            switch ($operation) {
                case 'add':
                    $result = add($num1, $num2);
                    break;
                case 'subtract':
                    $result = subtract($num1, $num2);
                    break;
                case 'multiply':
                    $result = multiply($num1, $num2);
                    break;
                case 'divide':
                    $result = divide($num1, $num2);
                    break;
                default:
                    $error = 'Некорректная операция';
            }
        } else {
            $error = "Пожалуйста, введите числа и выберите операцию.";
        }
    }
    if (isset($_POST['display_digits'])) {
      $a = isset($_POST['range_a']) ? intval($_POST['range_a']) : '';
      $b = isset($_POST['range_b']) ? intval($_POST['range_b']) : '';
      if(is_int($a) && is_int($b) && $a > 0 && $b > 0) {
        $digitsResult = displayDigitsRange($a, $b);
      } else {
          $error = 'Введите корректные значения для A и B.';
      }
    }
}

function calculateSequence($n) {
    $b = 5;
    if ($n == 1) {
        return $b;
    }
    for ($i = 1; $i < $n; $i++) {
        $denominator = add(multiply($i, $i), add($i, 1));
        $b = divide($b, $denominator);
    }
    return $b;
}
function displayDigits($n, &$output) {
   if ($n < 10) {
        $output .= $n . ' ';
        return;
    }
    displayDigits(intval($n / 10), $output);
    $output .= ($n % 10) . ' ';
}
function displayDigitsRange($a, $b) {
    $output = '';
    for ($i = $a; $i <= $b; $i++) {
        $output .= "Число $i: ";
        displayDigits($i, $output);
        $output .= "<br>";
    }
    return $output;
}
?>


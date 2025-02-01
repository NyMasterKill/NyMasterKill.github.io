<?php
function add($a, $b) {
  return $a + $b;
}
function subtract($a, $b) {
  return $a - $b;
}
function multiply($a, $b) {
  return $a * $b;
}
function divide($a, $b) {
  if ($b == 0) {
    return "Деление на ноль!";
  }
  return $a / $b;
}
?>
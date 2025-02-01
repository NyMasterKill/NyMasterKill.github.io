<?php
require 'controller.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Математический Калькулятор</title>
</head>
<body>

    <h1>Математический Калькулятор</h1>

    <form method="post">
        <label for="num1">Число 1:</label>
        <input type="text" name="num1" id="num1" required><br><br>

        <label for="num2">Число 2:</label>
        <input type="text" name="num2" id="num2" required><br><br>

        <label for="operation">Операция:</label>
        <select name="operation" id="operation" required>
            <option value="">Выберите операцию</option>
            <option value="add">Сложение (+)</option>
            <option value="subtract">Вычитание (-)</option>
            <option value="multiply">Умножение (*)</option>
            <option value="divide">Деление (/)</option>
        </select><br><br>

        <button type="submit" name="calculate_operation">Вычислить операцию</button>
    </form>

    <hr>

    <h2>Вычисление последовательности b(n)</h2>
    <form method="post">
        <label for="sequence_n">Введите n:</label>
        <input type="text" name="sequence_n" id="sequence_n" required oninput="this.value = this.value.replace(/[^0-9]/g, '')"><br><br>
        <button type="submit" name="calculate">Вычислить последовательность</button>
    </form>

    <hr>

    <h2>Вывод цифр в прямом порядке</h2>
    <form method="post">
        <label for="range_a">Введите A:</label>
        <input type="text" name="range_a" id="range_a" required oninput="this.value = this.value.replace(/[^0-9]/g, '')"><br><br>

        <label for="range_b">Введите B:</label>
        <input type="text" name="range_b" id="range_b" required oninput="this.value = this.value.replace(/[^0-9]/g, '')"><br><br>
        <button type="submit" name="display_digits">Вывести цифры</button>
    </form>

    <hr>

    <div id="calculator-result">
        <?php if (isset($error) && $error): ?>
            <p style="color: red;">Ошибка калькулятора: <?php echo $error; ?></p>
        <?php elseif (isset($result) && $result !== ''): ?>
            <p>Результат операции: <?php echo $result; ?></p>
        <?php endif; ?>
    </div>

    <div id="sequence-result">
        <?php if (isset($sequenceResult) && $sequenceResult !== ''): ?>
          <p>Результат последовательности: <?php echo $sequenceResult; ?></p>
        <?php endif; ?>
    </div>
     <div id="digits-result">
        <?php if(isset($digitsResult) && $digitsResult): ?>
            <p><?php echo $digitsResult; ?></p>
        <?php endif; ?>
    </div>

    <script>
         document.addEventListener('input', function(event) {
            if (event.target.matches('#num1') || event.target.matches('#num2')) {
                validateInput(event.target);
            }
        });

        function validateInput(input) {
            // Удаляем все символы, кроме цифр, точки и минуса
            input.value = input.value.replace(/[^0-9.-]/g, '');
            
            // Проверка на минус в начале и сразу после него цифра
            if (input.value.startsWith('-')) {
                if (input.value.length > 1 && !/[0-9]/.test(input.value[1])) {
                    input.value = input.value.substring(0, 1);
                }
            }
            
            // Удаляем все остальные минусы
            if (input.value.indexOf('-') !== -1 && input.value[0] !== '-') {
                input.value = input.value.replace(/-/g, '');
            }

            // Гарантируем, что есть только одна точка
            input.value = input.value.replace(/(\..*)\./g, '$1');
        }
    </script>
</body>
</html>
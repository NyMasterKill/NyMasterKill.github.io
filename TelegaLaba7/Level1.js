let display = document.getElementById('display');
let expression = '';
let allowedChars = '0123456789-+*/().^';
let lastChar = '';
let hasNumber = false;
display.addEventListener('input', function() {
  let input = display.value;
  let validInput = '';
  for (let i = 0; i < input.length; i++) {
    if (allowedChars.indexOf(input[i]) !== -1) {
      if (lastChar === '+' || lastChar === '-' || lastChar === '*' || lastChar === '/' ) {
        if (input[i] === '+' || input[i] === '-' || input[i] === '*' || input[i] === '/') {
          continue; 
        }
        if (input[i] === '(' && (lastChar === '+' || lastChar === '-' || lastChar === '*' || lastChar === '/')) {
          validInput += input[i];
          lastChar = input[i];
          continue; 
        }
      }
      if (input[i] === '^' && (lastChar === '+' || lastChar === '-' || lastChar === '*' || lastChar === '/' || lastChar === '^' || !hasNumber)) {
        continue;
      }
      if ((input[i] === '*' || input[i] === '/') && !hasNumber) { 
        continue; 
      } 
      validInput += input[i];
      lastChar = input[i];
      if (input[i] >= '0' && input[i] <= '9') {
        hasNumber = true;
      } else if (input[i] === '(') {
        hasNumber = false;
      }
    }
  }
  display.value = validInput;
  expression = validInput;
});

function appendNumber(num) {
  display.value += num;
  expression += num;
  lastChar = num;
  hasNumber = true;
}
function appendOperator(operator) {
  if (operator === '^' && !hasNumber) {
    return;
  }
  if (expression.length > 0 && 
      (expression[expression.length - 1] === '+' ||
       expression[expression.length - 1] === '-' ||
       expression[expression.length - 1] === '*' ||
       expression[expression.length - 1] === '/' ||
       expression[expression.length - 1] === '^' )) {
    return;
  }
  if ((operator === '*' || operator === '/') && !hasNumber) {
    return;
  }
  display.value += operator;
  expression += operator;
  lastChar = operator;
}
function clearDisplay() {
  display.value = '';
  expression = '';
  lastChar = '';
  hasNumber = false;
}
function calculate() {
  try {
    expression = expression.replace(/(\d)\(/g, '$1*(');
    expression = expression.replace(/\^/g, '**');
    let result = eval(expression);
    display.value = result;
    expression = result.toString();
    lastChar = result.toString()[result.toString().length - 1];
    hasNumber = true;
  } catch (error) {
    display.value = 'Ошибка';
  }
}
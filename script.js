document.addEventListener('input', (event) => {
    if (event.target.matches('#num1') || event.target.matches('#num2')) {
        validateInput(event.target);
    }
});
const validateInput = (input) => {
    input.value = input.value.replace(/[^0-9.-]/g, '');
    if (input.value.startsWith('-') && input.value.length > 1 && !/[0-9]/.test(input.value[1])) {
        input.value = input.value.substring(0, 1);
    }
    if (input.value.indexOf('-') !== -1 && input.value[0] !== '-') {
        input.value = input.value.replace(/-/g, '');
    }
    input.value = input.value.replace(/(\..*)\./g, '$1');
};
const sendRequest = async (formId, action) => {
    const form = document.getElementById(formId);
    const formData = new FormData(form);
    formData.append('action', action);

    const response = await fetch('controller.php', {
        method: 'POST',
        body: formData
    });

    if (!response.ok) {
        const message = `Error: ${response.status}`;
        throw new Error(message);
    }

    return await response.json();
};
const handleCalculation = async (formId, action, resultElementId, successMessageCallback) => {
   try {
      const result = await sendRequest(formId, action);
      const resultElement = document.getElementById(resultElementId);
      if (result.error) {
         resultElement.innerHTML = `<p style="color: red;">Ошибка: ${result.error}</p>`;
      } else if (successMessageCallback) {
        resultElement.innerHTML = successMessageCallback(result);
      }
   } catch (error) {
      document.getElementById(resultElementId).innerHTML = `<p style="color: red;">Произошла ошибка: ${error.message}</p>`;
    }
};
const calculateOperation = () => {
    handleCalculation('calculator-form', 'calculate_operation', 'calculator-result',
        (result) => `<p>Результат операции: ${result.result}</p>`);
};
const calculateSequence = () => {
    handleCalculation('sequence-form', 'calculate', 'sequence-result',
        (result) => `<p>Результат последовательности: ${result.sequenceResult}</p>`);
};
const displayDigits = () => {
    handleCalculation('digits-form', 'display_digits', 'digits-result',
        (result) => `<p>${result.digitsResult}</p>`);
};


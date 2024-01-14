// const numbers = document.querySelectorAll('.digit');

// 入力した数値(.digit)をアウトプットに出力

// 入力した数値(.digit)を保持

// .operator入力後displayをクリア

// .operatorをdisplayに表示

// displayをクリア

document.addEventListener("DOMContentLoaded", function () {
    const display = document.getElementById("display");
    const buttons = document.getElementById("buttons");
    let currentInput = "";
    let storedValue = null;
    let operator = null;

    buttons.addEventListener("click", function (event) {
        const target = event.target;

        if (target.classList.contains("digit")) {
            handleDigitClick(target.textContent);
        } else if (target.classList.contains("operator")) {
            handleOperatorClick(target.textContent);
        } else if (target.id === "equals") {
            handleEqualsClick();
        } else if (target.id === "clear") {
            handleClearClick();
        }
    });

    function handleDigitClick(digit) {
        currentInput += digit;
        updateDisplay();
    }

    function handleOperatorClick(op) {
        if (currentInput !== "") {
            if (storedValue !== null) {
                calculate();
            } else {
                storedValue = parseFloat(currentInput);
            }
            operator = op;
            currentInput = "";
            updateDisplay();
        }
    }

    function handleEqualsClick() {
        if (storedValue !== null && currentInput !== "") {
            calculate();
            operator = null;
        }
        updateDisplay();
    }

    function handleClearClick() {
        currentInput = "";
        storedValue = null;
        operator = null;
        updateDisplay();
    }

    function calculate() {
        const currentValue = parseFloat(currentInput);
        switch (operator) {
            case "+":
                storedValue += currentValue;
                break;
            case "-":
                storedValue -= currentValue;
                break;
            case "*":
                storedValue *= currentValue;
                break;
            case "/":
                storedValue /= currentValue;
                break;
        }
        currentInput = "";
    }

    function updateDisplay() {
        display.textContent = currentInput !== "" ? currentInput : storedValue !== null ? storedValue : "0";
    }
});


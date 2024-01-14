

const createList = () => {
    const ulElement = document.getElementById('todo-list');
    const liElement = document.createElement("li");
    liElement.classList = "todo-item";
    const inputElement = document.createElement("input");
    inputElement.setAttribute("type", "checkbox");
    liElement.appendChild(inputElement);
    const spanElement = document.createElement("span");
    liElement.appendChild(spanElement);
    const buttonElement = document.createElement("button");
    buttonElement.classList = "delete-button";
    buttonElement.textContent = '削除';
    liElement.appendChild(buttonElement);
    const targetInput = document.getElementById("todo-input");
    spanElement.textContent = targetInput.value;
    targetInput.value = '';

    ulElement.appendChild(liElement);

};


const addButton = document.getElementById('add-button');
addButton.addEventListener("click", (event) => {
    event.preventDefault();
    createList();
});



document.addEventListener('click', (e) => {
    const deleteButtons = document.querySelectorAll('.delete-button');
    const inputTargets = document.querySelectorAll('input[type="checkbox"]');
    if (!deleteButtons.length === 0) return;

    deleteButtons.forEach((deleteButton) => {
        if (e.target === deleteButton) {
            const targetList = e.target.closest('li');
            targetList.remove();
        }
    });

    inputTargets.forEach((inputTarget) => {
        if (inputTarget.checked === true) {
            inputTarget.nextElementSibling.classList = "text-line";
        } else {
            inputTarget.nextElementSibling.classList = "";
        }
    });
});

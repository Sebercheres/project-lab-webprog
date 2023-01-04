document.addEventListener("DOMContentLoaded", function () {
    const addInput = document.querySelector("#add-input");
    const inputContainer = document.querySelector("#input-container");
    const inputTemplate = document.querySelector("#input-template");

    addInput.addEventListener("click", () => {
        const input = inputTemplate.content.cloneNode(true);
        inputContainer.appendChild(input);
    });
});

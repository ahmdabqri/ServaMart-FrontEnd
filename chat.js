const sendBtn =
document.querySelector(".send-btn");

const chatInput =
document.querySelector(".chat-input input");

const chatMessages =
document.querySelector(".chat-messages");

sendBtn.addEventListener("click", () => {

    const text = chatInput.value.trim();

    if(text === "") return;

    const message =
    document.createElement("div");

    message.classList.add(
        "message",
        "sent"
    );

    message.textContent = text;

    chatMessages.appendChild(message);

    chatInput.value = "";

});
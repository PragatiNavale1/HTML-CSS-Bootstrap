function sendMessage() {
  let userInput = document.getElementById("user-input").value;
  let chatBox = document.getElementById("chat-box");

  if (userInput.trim() === "") return;

  // Add user message
  let userMessage = `<div class="message user-message">${userInput}</div>`;
  chatBox.innerHTML += userMessage;

  // Scroll to bottom
  chatBox.scrollTop = chatBox.scrollHeight;

  fetch("chatbot.php", {
    method: "POST",
    body: new URLSearchParams({ message: userInput }),
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
  })
    .then((response) => response.text())
    .then((data) => {
      let botMessage = `<div class="message bot-message">${data}</div>`;
      chatBox.innerHTML += botMessage;

      // Smooth scrolling
      chatBox.scrollTop = chatBox.scrollHeight;
    });

  document.getElementById("user-input").value = "";
}

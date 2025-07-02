/*!
* Start Bootstrap - Shop Homepage v5.0.6 (https://startbootstrap.com/template/shop-homepage)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-shop-homepage/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project

  const chatForm = document.getElementById("chatForm");
  const chatBox = document.getElementById("chatBox");
  const chatInput = document.getElementById("chatInput");

  chatForm.addEventListener("submit", function (e) {
    e.preventDefault();
    const msg = chatInput.value.trim();
    if (!msg) return;

    const userMsg = `
      <div class="mb-3 text-end">
        <div>
          <strong class="text-dark">You</strong>
          <div class="text-muted small">${msg}</div>
        </div>
      </div>
    `;
    chatBox.insertAdjacentHTML("beforeend", userMsg);
    chatInput.value = "";
    chatBox.scrollTop = chatBox.scrollHeight;
  });


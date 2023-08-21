document.addEventListener("DOMContentLoaded", function() {
  var phoneInput = document.getElementById("cart-phone");
  var submitButton = document.querySelector(".ot-btn-done");
  var invalidFeedback = document.createElement("div");
  invalidFeedback.classList.add("invalid-feedback");
  phoneInput.parentNode.appendChild(invalidFeedback);

  var overlay = document.querySelector(".overlay"); 

  phoneInput.addEventListener("input", function() {
    var cleanedInput = phoneInput.value.replace(/[^\d+]/g, "");
    phoneInput.value = cleanedInput;

    var digitCount = (cleanedInput.match(/\d/g) || []).length;
    if (digitCount < 11) {
      submitButton.disabled = true;
      phoneInput.classList.add("is-invalid");
      invalidFeedback.innerText = "Введите верный номер телефона";
      if (!overlay) { 
        overlay = document.createElement("div"); /
        overlay.classList.add("overlay"); 
        submitButton.parentNode.appendChild(overlay); 
        overlay.style.position = "absolute";
        submitButton.parentNode.style.position = "relative";
        //console.log("Кнопка Оплатить деактивирована");
      }
      overlay.style.display = "block";
      overlay.style.opacity = "0.5";
    } else {
      submitButton.disabled = false;
      phoneInput.classList.remove("is-invalid");
      invalidFeedback.innerText = "";
      if (overlay) { 
        overlay.parentNode.removeChild(overlay); 
        //console.log("Кнопка Оплатить активирована");
      }
    }
  });
    submitButton.addEventListener("click", function(event) {
    if (!submitButton.disabled) {
      submitButton.disabled = true;
      event.preventDefault();
      // отправка формы на сервер
      // после выполнения отправки, разблокировка кнопки
    }
  });
});

document.addEventListener("change", function (event) {
  if (event.target.tagName === "SELECT") {
    let values = [];
    let container = event.target.closest(".card-body");
    let selects = container.querySelectorAll("select");

    selects.forEach(function (selectEl) {
      if (selectEl.value !== "0") {
        values.push(selectEl.value);
      }
    });

    selects.forEach(function (selectEl) {
      Array.from(selectEl.options).forEach(function (option) {
        option.style.display = "block";
      });

      values.forEach(function (value) {
        let optionToHide = selectEl.querySelector(
          'option[value="' + value + '"]'
        );
        if (optionToHide) {
          optionToHide.style.display = "none";
        }
      });
    });
  }
});

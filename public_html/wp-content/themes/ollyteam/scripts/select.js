const select = document.querySelector('.ot-modal-calendar__category-select');
const buttons = document.querySelectorAll('.ot-modal-calendar__category-btn');

buttons.forEach(button => {
  button.addEventListener('click', () => {
    const value = button.getAttribute('data-selected');
    const option = [...select.options].find(opt => opt.value === value);
    if (option) {
      select.value = option.value;
      select.querySelectorAll('option[selected]').forEach(opt => opt.removeAttribute('selected'));
      option.setAttribute('selected', '');
      
      // Выводим лог в консоль разработчика
      console.log(`Выбрана категория "${option.innerText}"`);
    } else {
      // Выводим лог в консоль разработчика
      console.error(`Категория с значением "${value}" не найдена`);
    }
  });
});

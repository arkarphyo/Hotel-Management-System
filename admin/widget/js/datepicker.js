function createDatePicker(input) {
  const calendar = document.createElement('div');
  calendar.className = 'datepicker-calendar';
  document.body.appendChild(calendar);

  function renderCalendar(date) {
    calendar.innerHTML = '';
    const selectedDate = new Date(date);
    const month = selectedDate.getMonth();
    const year = selectedDate.getFullYear();
    const firstDay = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    let html = `<table><thead><tr>`;
    ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'].forEach(d => {
      html += `<th>${d}</th>`;
    });
    html += `</tr></thead><tbody><tr>`;

    for (let i = 0; i < firstDay; i++) html += '<td></td>';
    for (let d = 1; d <= daysInMonth; d++) {
      const fullDate = new Date(year, month, d).toISOString().split('T')[0];
      html += `<td data-date="${fullDate}">${d}</td>`;
      if ((d + firstDay) % 7 === 0) html += '</tr><tr>';
    }

    html += '</tr></tbody></table>';
    calendar.innerHTML = html;

    calendar.querySelectorAll('td[data-date]').forEach(td => {
      td.addEventListener('click', () => {
        input.value = td.dataset.date;
        calendar.style.display = 'none';
      });
    });
  }

  input.addEventListener('focus', () => {
    const rect = input.getBoundingClientRect();
    calendar.style.top = `${rect.bottom + window.scrollY}px`;
    calendar.style.left = `${rect.left + window.scrollX}px`;
    renderCalendar(new Date());
    calendar.style.display = 'block';
  });

  document.addEventListener('click', (e) => {
    if (!calendar.contains(e.target) && e.target !== input) {
      calendar.style.display = 'none';
    }
  });
}


db.literature.insertMany([
  {
    type: "book",
    title: "Володар перстнів",
    isbn: "654-966-12-6401-1",
    publisher: "Фентазієн",
    year: 1980,
    pages: 984,
    authors: ["Джон Толкієн"]
  },
  {
    type: "book",
    title: "Філософія права",
    isbn: "978-617-10-0011-5",
    publisher: "Юрінком Інтер",
    year: 2015,
    pages: 280,
    authors: ["Іван Петренко", "Ольга Сидорова"]
  },
  {
    type: "book",
    title: "Програмування на Python",
    isbn: "978-617-577-123-0",
    publisher: "Видавництво Старого Лева",
    year: 2022,
    pages: 512,
    authors: ["Андрій Шевченко"],
    hasCD: true
  },
  {
    type: "magazine",
    title: "Наука і життя",
    year: 2023,
    issueNumber: 4,
    publisher: "Науковий світ",
    hasCD: true
  },
  {
    type: "magazine",
    title: "Forbes Україна",
    year: 2024,
    issueNumber: 2,
    publisher: "Forbes Media"
  },
  {
    type: "newspaper",
    title: "Дзеркало тижня",
    year: 2024,
    publisher: "Інтерфакс-Україна"
  },
  {
    type: "book",
    title: "Алгоритми: побудова та аналіз",
    isbn: "978-617-7341-26-4",
    publisher: "Київський університет",
    year: 2018,
    authors: ["Рональд Рівест", "Кліффорд Стайн"]
  },
  {
    type: "magazine",
    title: "Комп'ютерні науки",
    year: 2021,
    issueNumber: 8,
    publisher: "ТехноПрес"
  }
]);

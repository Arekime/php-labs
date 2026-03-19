<?php
/**
 * Клас Athlete — модель спортсмена
 *
 * Використовується у всіх завданнях ЛР3 (варіант ).
 */

class Athlete
{
    public string $name;
    public int $rating;
    public string $sport;

    /**
     * Конструктор — задає початкові значення властивостей
     */
    public function __construct(string $name = '', int $rating = 0, string $sport = '')
    {
        $this->name = $name;
        $this->rating = $rating;
        $this->sport = $sport;
    }

    /**
     * Виводить інформацію про товар
     */
    public function getInfo(): string
    {
        return "Товар: {$this->name}, Рейтинг: {$this->rating}, Спорт: {$this->sport}";
    }

    /**
     * При клонуванні — встановлює значення за замовчанням
     */
    public function __clone(): void
    {
        $this->name = 'Новий спортсмен';
        $this->rating = 0;
        $this->sport = 'Без спорту';
    }
}

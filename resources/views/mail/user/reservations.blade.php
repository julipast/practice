<x-mail::message>
    # Нагадування

    Бронювання розпочнеться:
    {{ $reservation->start_date }}

    Дякуємо,
    {{ config('app.name') }}
</x-mail::message>

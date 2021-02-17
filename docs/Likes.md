# ❤️ Лайки (Likes)

### Поставить лайк

С помощью этой функции можно поставить лайк куда угодно.

``` php
// $type — Тип контента (wall | photo и т.д)
// $owner_id — Айди владельца записи
// $item_id — Айди записи
add(string $type, int $owner_id, int $item_id)

// Пример
$user->getLikes()->add('photo', -1, 1);
```

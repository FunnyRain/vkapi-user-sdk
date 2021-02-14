# ⚙️ Api (VkApiRequest)

### Вызов метода из документации вк
Без комментариев.

```php
// $method — Название метода
// $params — Параметры (могут быть пустыми)

// Вернёт массив с данными
api(string $method, array $params = [])

// Пример
$user->VkApiRequest()->api('account.getProfileInfo', [])
```
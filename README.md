# neaktor-class

Для работы с api 'neaktor' нужно инициализировать класс Neaktor
и вызвать функцию подключения `neoconn` , `neoconn` имеет два обязательных параметра `url`,`token` и два не обязательных параметра `body`, `method`.
`url` -> нужная ссылка, `token` -> токен для аунтификации, `body` -> тело запроса (json массив), есди не указан запрос отправляется без тела , `method` -> нужный метод (post, put...) если не указан используется get метод.

## neoconn
функция подключения к api, возвращает json массив

```
// get request

$url = 'https://api.neaktor.com/v1/tasks/5385604';
$token = 'TOKEN HERE';

$Neaktor = new Neaktor(); 
$data = $Neaktor->neoconn($url, $token,);
print_r($data);
```

```
// delete request

$url = 'https://api.neaktor.com/v1/tasks/5385604';
$token = 'TOKEN HERE';

$json_string_delete = '
     {
        "deleted": true,
        "message": "101"
     }
     ';

$Neaktor = new Neaktor(); 
$data = $Neaktor->neoconn($url, $token, $body, 'DELETE');
print_r($data);
```

## picker 
На вход требуется `id_field` и `key`, где `id_field` -> id нужного поля, `key` -> поле которое нужно вывести, возвращает значение `key`. Работет только с get запросом и если выбранна одна задача!

```
// picker

$url = 'https://api.neaktor.com/v1/tasks/5385604';
$token = 'TOKEN HERE';

$id = 'createddate';
$key = 'value';

$Neaktor = new Neaktor();  
$data = $Neaktor->neoconn($url, $token');
echo $Neaktor->picker($id, $key);
```



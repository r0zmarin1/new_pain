Установка
=========

Установите `Composer` и выполните следующую команду, чтобы получить последнюю версию:

```php
    composer require "twig/twig:^3.0"
```
[Composer](https://getcomposer.org/download/)

Этот документ описывает синтаксис и семантику шаблона и будет наиболее полезен для тех, кто создает шаблоны TWIG.

[Документация по TWIG](https://twig.symfony.com/doc/3.x/)
### Краткий обзор

Шаблон - это просто текстовый файл. Он может генерировать любой текстовый формат (HTML, XML, CSV, Latex, и т.д.). Он не обязан иметь особого расширения, .html, или .xml расширения подойдут.

Шаблон содержит переменные или выражения, которые будут заменяться значениями, когда шаблон вычисляется, и теги, которые контролируют логику шаблона.

Ниже приводится минимальный шаблон, который иллюстрирует основы. Мы рассмотрим детали позже:

```php
    <!DOCTYPE html>
    <html>
        <head>
            <title>My Webpage</title>
        </head>
        <body>
            <ul id="navigation">
            {% for item in navigation %}
                <li><a href="{{ item.href }}">{{ item.caption }}</a></li>
            {% endfor %}
            </ul>
    
            <h1>My Webpage</h1>
            {{ a_variable }}
        </body>
    </html>
```


Есть два вида разделителей: `{% ... %}` И `{{ ... }}`. Первый из них используется для выполнения операторов, таких как for-циклы , последний печатает результат выражения в шаблон.



### Переменные

Приложение передает переменные, с которыми вы можете работать в шаблоне. Переменные могут иметь атрибуты или элементы, к которым вы можете иметь доступ. Как выглядит переменная определяется приложением, которое ее предоставило. Вы можете использовать точку (.) чтобы получить доступ к атрибутам переменной (методы или свойства PHP-объекта или элементы PHP- массива), или так называемый индекс (\[\]):
```php
    {{ foo.bar }}
    {{ foo['bar'] }}
```

Когда атрибут содержит специальные символы (такие как - что будет интерпретировано как оператор вычитания ), используйте функцию attribute вместо доступа к атрибуту переменной.
```php
    {# equivalent to the non-working foo.data-foo #}
    {{ attribute(foo, 'data-foo') }}
```
> Важно знать,что фигурные скобки не являются переменной, а печатают предложение.  
> Если вы хотите получить доступ к переменным внутри тегов, не ставьте скобки.

Если переменная или атрибут не существует, вы получите значение `null` , когда опция `strict\_variables` установлена `false`, в обратном случае Twig выбросит ошибку.

### Реализация

Для удобства `foo.bar` делает следующие вещи на уровне PHP:

*   проверяет является ли `foo` массивом и `bar` верным выражением;
*   если нет, и `foo` является объектом, проверяется что `bar` является допустимым свойством
*   если нет, и `foo` является объектом, проверяется что `bar` является допустимым методом (даже если bar является конструктором - используйте `use\_\_construct()` вместо этого)
*   если нет, и `foo` является объектом, проверяется что `getBar` является допустимым методом
*   если нет, и `foo` является объектом, проверяется что `isBar` является допустимым методом
*   если нет, то возвращает значение `null`

С другой стороны, `foo['bar']` работает только с массивами PHP:

*   проверяется, является ли `foo` массивом и `bar` допустимым элементом
*   если нет , то возвращает значение `null`

Если вы хотите получить динамический атрибут для переменной, используйте функцию `attribute` вместо этого.

### Глобальные переменные

Следующие переменные всегда доступны в шаблонах:

*   `_self`: ссылается на текущий шаблон;
*   `_context`: ссылается на текущий контекст;
*   `_charset`: ссылается на текущую кодировку.

### Присвоение переменных

Вы можете придать значения переменных внутри блоков кода. Присвоения используют тег set :
```php
    {% set foo = 'foo' %}
    {% set foo = [1, 2] %}
    {% set foo = {'foo': 'bar'} %}
```
### Фильтры

Переменные могут быть изменены с помощью фильтров filters. Фильтры отделяются от переменных с помощью pipe-символа (|) и могут иметь дополнительные аргументы в скобках. Можно объединять несколько фильтров. Выход одного фильтра направляется в следующий.

Следующий пример удаляет все HTML-теги и title из name:
```php
    {{ name|striptags|title }}
```
Фильтры, которые принимают аргументы,имеют круглые скобки вокруг аргументов. Этот пример присоединит список, разделенный запятой.
```php
    {{ list|join(', ') }}
```
Чтобы применить фильтр для секции в коде, оберните его с тегом `filter`:
```php
    {% filter upper %}
        This text becomes uppercase
    {% endfilter %}
```


### Функции

Можно вызывать функции чтобы генерировать контент. Функции могут быть вызваны по имени со скобками после него и могут иметь аргументы.

Например, функция range возвращает список, содержащий арифметическую прогрессию целых чисел:
```php
    {% for i in range(0, 3) %}
        {{ i }},
    {% endfor %}
```
Чтобы узнать больше о встроенных функциях зайдите на страницу `functions`.

### Именованные аргументы
```php
    {% for i in range(low=1, high=10, step=2) %}
        {{ i }},
    {% endfor %}
```
Использование именованных аргументов помогает понять значение переменных, которые вы передаете как аргументы.
```php
    {{ data|convert_encoding('UTF-8', 'iso-2022-jp') }}
    
    {# versus #}
    
    {{ data|convert_encoding(from='iso-2022-jp', to='UTF-8') }}
```
Именованные аргументы также позволяют пропустить некоторые аргументы, для которых вы не хотите изменять значение по умолчанию:
```php
    {# the first argument is the date format, which defaults to the global date format if null is passed #}
    {{ "now"|date(null, "Europe/Paris") }}
    
    {# or skip the format value by using a named argument for the timezone #}
    {{ "now"|date(timezone="Europe/Paris") }}
```
Вы также можете использовать позиционные и именованные аргументы в одном вызове, и в этом случае позиционные аргументы должны идти впереди именованных аргументов.
```php
    {{ "now"|date("d/m/Y H:i", timezone="Europe/Paris") }}
```
> Каждая страница документации по функциям и фильтрам имеет раздел, где имена всех аргументов выписаны, если они поддерживаются.

### Управляющая структура

Управляющая структура относится к тем вещам, которые управляют программой - условия (i.e. if/elseif/else), for-циклы и блоки. Управляющая структура появляется внутри блоков {% ... %}.

Например, чтобы показать список всех пользователей, которые записаны в переменной users , используйте тег `for`:
```php
    <h1>Members</h1>
    <ul>
        {% for user in users %}
            <li>{{ user.username|e }}</li>
        {% endfor %}
    </ul>
```
Тег `if` можно использовать чтобы проверить выражение:
```php
    {% if users|length > 0 %}
        <ul>
            {% for user in users %}
                <li>{{ user.username|e }}</li>
            {% endfor %}
        </ul>
    {% endif %}
```

### Комментарии

Чтобы закомментировать часть строки шаблона, используйте комментарий `{# ... #}`. Это полезно для отладки или для добавления информации для других разработчиков или для себя:
```php
    {# note: disabled template because we no longer use this
        {% for user in users %}
            ...
        {% endfor %}
    #}
```
### Включение других шаблонов

Тэг `include` используется для включения шаблона и включению использованного контента к текущему:
```php
    {% include 'sidebar.html' %}
```
По умолчанию включенные шаблоны передаются в текущий контекст.

Контекст, который передается во включенный шаблон включает переменные, определенные в шаблоне:
```php
    {% for box in boxes %}
        {% include "render_box.html" %}
    {% endfor %}
```
Включенный шаблон `render\_box.html` может получить доступ к `box`.

Имя файла шаблона зависит от загрузчика шаблона. Например, `Twig\_Loader\_Filesystem` позволяет получить доступ к другим шаблонам по имени. Вы можете включить шаблоны в ниже лежащих директориях используя знак слэша:
```php
    {% include "sections/articles/sidebar.html" %}
```
Это поведение зависит от приложения, в которое встраивается Twig.

### Наследование шаблонов

Наиболее мощное средство Twig это наследование шаблонов. Оно позволяет вам построить базовый "скелет" шаблона,который содержит все общие элементы вашего сайта и определяет блоки, которые дочерние шаблоны могут замещать.

Звучит сложно, но на самом деле все очень просто. Это легко понять с помощью следующего примера.

Давайте определим базовый шаблон, base.html, который определяет простой HTML скелетный документ, который вы можете использовать для простой страницы с двумя колонками:
```php
    <!DOCTYPE html>
    <html>
        <head>
            {% block head %}
                <link rel="stylesheet" href="style.css" />
                <title>{% block title %}{% endblock %} - My Webpage</title>
            {% endblock %}
        </head>
        <body>
            <div id="content">{% block content %}{% endblock %}</div>
            <div id="footer">
                {% block footer %}
                    &amp;copy; Copyright 2011 by <a href="http://domain.invalid/">you</a>.
                {% endblock %}
            </div>
        </body>
    </html>
```
В этом примере, теги `block` определяют четыре блока , которые дочерние шаблоны могут занять. Все , что делает тег `block` это то, что он говорит механизму шаблонов,что ребенок может замещать те части шаблона.

Шаблон-потомок может выглядеть так:
```php
    {% extends "base.html" %}
    
    {% block title %}Index{% endblock %}
    {% block head %}
        {{ parent() }}
        <style type="text/css">
            .important { color: #336699; }
        </style>
    {% endblock %}
    {% block content %}
        <h1>Index</h1>
        <p class="important">
            Welcome to my awesome homepage.
        </p>
    {% endblock %}
```
Тег `extends` очень важен здесь. Он говорит механизму шаблонов, что этот шаблон "расширяет" другой шаблон. Когда система шаблонов вычисляет этот шаблон, сначала он ищет родителя. Тег `extends` должен быть первым тегом в шаблоне. Следует заметить, что так как шаблон-ребенок не определяет блок `footer` , используется значение из родительского шаблона.

Возможно передать содержание родительского шаблона используя функцию `parent`.

Это дает результаты родительского блока:
```php
    {% block sidebar %}
        <h3>Table Of Contents</h3>
        ...
        {{ parent() }}
    {% endblock %}
```
> Страница документации для тега extends описывает более сложные особенности , такие как вложенные блоки, области видимости, динамическое наследование и условное наследование.
>
> Twig также поддерживает множественное наследование с так называемым горизонтальным повторным использованием с помощью тега use. Эта сложная особенность вряд ли понадобится в обычных шаблонах.

### Экранирование HTML

При генерации HTML из шаблонов всегда есть риск , что переменная будет включать символы, которые будут влиять на конечный HTML. Существует два подхода: вручную сохранять каждую переменную или автоматически сохранить все по умолчанию.

Twig поддерживает оба, автоматическое сохранение включено по умолчанию.

> Автоматическое сохранение поддерживается только если расширение escaper включено (что так и есть по умолчанию).

#### Работа с экранированием вручную

Если сохранение вручную включено, это ваша обязанность сохранить все переменные если это нужно. Что нужно сохранить? Все переменные, которым вы не доверяете.

Сохранение работает , если пропустить переменную через escape или e фильтр:
```php
    {{ user.username|e }}
```
По умолчанию, фильтр escape использует html метод, но в зависимости от сохраняемого контекста, вы возможно захотите использовать другие методы:
```php
    {{ user.username|e('js') }}
    {{ user.username|e('css') }}
    {{ user.username|e('url') }}
    {{ user.username|e('html_attr') }}
```
#### Автоматическое экранирование

Вне зависимости от того, включено ли автоматическое сохранение или нет, вы можете выделить секцию шаблона, которую нужно или не нужно сохранить, используя тег `autoescape`:
```php
    {% autoescape %}
        Everything will be automatically escaped in this block (using the HTML strategy)
    {% endautoescape %}
```
По умолчанию, авто-сохранение сохраняет html. Если выводить переменные в других контекстах, нужно явно сохранить их, используя подходящий метод:
```php
    {% autoescape 'js' %}
        Everything will be automatically escaped in this block (using the JS strategy)
    {% endautoescape %}
```
#### Экранирование

Иногда желательно или даже необходимо заставить Twig игнорировать те части, которые в противном случае он воспримет как переменные или как блоки.

Например, если синтаксис по умолчанию используется, и вы хотите использовать `{{` качестве исходного строки в шаблоне, а не начать переменную ,вы должны использовать трюк.

Самым простым способом для вывода переменной разделитель `{{` является использование выражения:
```php
    {{ '{{' }}
```
### Макросы

> поддержка значений аргументов была добавлена по умолчанию в Twig 1.12.

Макросы сравнимы с функциями в обычных языках программирования. Они полезны для повторного использования часто используемых HTML - фрагментов чтобы не повторять себя. Макрос определяется через macro теги. Вот небольшой пример (впоследствии называемый forms.html) макроса, который представлен в виде элемента формы:
```php
    {% macro input(name, value, type, size) %}
    
    {% endmacro %}
```
Макрос может быть определен в любом шаблоне, и должен быть "импортирован" через тег import до использования:
```php
    {% import "forms.html" as forms %}
    {{ forms.input('username') }}
```
Кроме того, вы можете импортировать отдельные имена макросов из шаблона в текущее пространство имен с помощью тега `from` или дать им имя:
```php
    {% from 'forms.html' import input as input_field %}
    
    Username
    {{ input_field('username') }}
    
    Password
    {{ input_field('password', '', 'password') }}
```
По умолчанию значение также может быть определено для макро аргументов прямо в вызове макроса:
```php
    {% macro input(name, value = "", type = "text", size = 20) %}
    
    {% endmacro %}
```
### Выражения

Twig позволяет выражения везде. Такая работа очень похожа на обычный PHP и даже если вы не работаете с PHP, вы почувствуете себя с ним комфортно.

### Литеры

Самой простой формой выражений являются литералы. Литералы представлены для таких типов PHP, как строки, числа и массивы. Существуют следующие литералы:

*   `"Hello World"`: Все между двумя двойными или одинарными кавычками является строкой. Они полезны, когда вам нужна строка в шаблоне (например, как аргументы функций,фильтры или для того чтобы просто расширить или включить шаблон). Строка может содержать разделитель, если ему предшествует обратный слеш () -- как в 'It's good'
*   `42 / 42,23`: Целые числа и числа с плавающей точкой создаются написанием чисел . Если точка есть в числе то это float, в противном случае integer.
*   `["foo", "bar"]`: Массивы определяются последовательностью выражений, разделенных запятыми (,) и окруженных квадратными скобками (\[\]).
*   `{"foo": "bar"}`: Хэши определяется списком ключей и значений, разделенных запятыми (,) и взятых в фигурные скобки ({}):

```php
    {# keys as string #}
    { 'foo': 'foo', 'bar': 'bar' }
    
    {# keys as names (equivalent to the previous hash) -- as of Twig 1.5 #}
    { foo: 'foo', bar: 'bar' }
    
    {# keys as integer #}
    { 2: 'foo', 4: 'bar' }
    
    {# keys as expressions (the expression must be enclosed into parentheses) -- as of Twig 1.5 #}
    { (1 + 1): 'foo', (a ~ 'b'): 'bar' }
```
*   `true/false`: true представляет истинное значение, false представляет ложное значение.
*   `null`: null не представляет никакого определенного значения. Это значение возвращается, когда переменной не существует. none является синонимом null.

Массивы и хэши могут быть вложенными:
```php
    {% set foo = [1, {"foo": "bar"}] %}
```
Использование двойных кавычек или одиночных кавычек не имеет никакого ьвлияния на производительность, но строки интерполяции поддерживается только для строк в двойных кавычках.

### Вычисления

Twig позволяет оперировать значениями. Это редко используется в шаблонах, но существует ради полноты. Поддерживаются следующие операторы:

*   `+`: Добавляет два объекта вместе (операнды преобразованы в числа). `{{1 + 1}}` равно 2.
*   `-`: Вычитает второе число из первого. `{{3 - 2}}` равно 1.
*   `/`: Деление двух чисел. Возвращенное значение будет числом с плавающей точкой. `{{1/2}}` есть 0,5.
*   `%`: Вычисляет остаток от целочисленного деления. `{{11% 7}}` есть 4.
*   `//` : Деление двух чисел и возвращает (в виде дроби) целый результат. `{{20 // 7}} = 2`, `{{-20 // 7}}` является -3
*   `*`: Умножает левый операнд на правый. `{{2 * 2}}` возвратится 4.
*   `**`: Генерирует левый операнд в степень правого операнда. `{{2 ** 3}}` возвратится 8.

### Логика

Вы можете объединить несколько выражений со следующими операторами:

*   `and`: Возвращает истину, если левый и правый операнды оба истинны.
*   `or`: Возвращает истину, если левый или правый операнд истинны.
*   `not`: Отрицает выражение.
*   `(expr)`: Групипровка вырожений.

> Twig также поддерживает побитовые операторы (b-and, b-xor, and b-or).

### Сравнения

Следующие операторы сравнения поддерживаются в любом выражении: `==`, `!=`, `<`, `>`, `>=` и `<=`.

Вы также можете проверить, если строка начинается или заканчивается другой строкой:
```php
    {% if 'Fabien' starts with 'F' %}
    {% endif %}
    
    {% if 'Fabien' ends with 'n' %}
    {% endif %}
```
Для сложных сравнений строк, оператор matches позволяет вам использовать регулярные вырожения:
```php
    {% if phone matches '{^[d.]+$}' %}
        ...
    {% endif %}
```
### Оператор in

Оператор in осуществляет проверку содержания.

Он возвращает true если левый операнд содержится в правом:
```php
    {# returns true #}
    
    {{ 1 in [1, 2, 3] }}
    
    {{ 'cd' in 'abcde' }}
```
> Вы можете использовать этот фильтр, чтобы выполнить проверку на содержание со строками, массивами или объектами, осуществляющих Traversable интерфейс.

Чтобы выполнить проверку на то, что левый операнд не содержится в правом, нужно использовать not in оператор.
```php
    {% if 1 not in [1, 2, 3] %}
    
    {# is equivalent to #}
    {% if not (1 in [1, 2, 3]) %}
```
### Операторы проверки

Оператор is выполняет тесты. Тесты могут быть использованы для тестирования переменной в отношении общего выражения. Правый операнд является именем теста:
```php
    {# find out if a variable is odd #}
    
    {{ name is odd }}
```
Тесты также используют аргументы:
```php
    {% if post.status is constant('Post::PUBLISHED') %}
```
Тесты могут быть инвертированы при использовании is not оператора:
```php
    {% if post.status is not constant('Post::PUBLISHED') %}
    
    {# is equivalent to #}
    {% if not (post.status is constant('Post::PUBLISHED')) %}
```
Перейдите на страницу tests чтобы узнать больше о встроенных тестах.

### Другие операторы

> Поддержка расширенного тройного оператора была добавлена в Twig 1.12.0.

Следующие операторы очень полезны, но не вписываются ни в какую из категорий:

*   `..`: Создает последовательность, основанную на операнде до и после оператора.
*   `|`: Применяет фильтр.
*   `~`: Преобразует все операнды в строки и объединяет их. Hello ! вернется (при условии, имя является «John») Hello John!.
*   `.`, `[]`: Получает атрибут объекта.
*   `? :`: Тернарный оператор оператор: `{{ foo ? 'yes' : 'no' }}`

### Строка интерполяции

> Строка интерполяции была добавлена в Twig 1.5.

Строка интерполяция (#{expression}) позволяет любое допустимое выражение появляться в двойных кавычках. Результатом вычисления является то что вставляется в строку:
```php
    {{ "foo #{bar} baz" }}
    {{ "foo #{1 + 2} baz" }}
```
### Управление пробелами

Первая новая строка после тега шаблона удаляется автоматически (как в PHP). Пробелы больше не изменяются механизмом шаблонов, поэтому каждый пробел (пробелы, табуляции, новые строки и т.д.) возвращается без изменений.

Вы также можете контролировать пробелы на уровне тегов. Используя модификаторы управления пробелами в ваших тегах, вы можете обрезать начальные и / или конечные пробелы.

Twig поддерживает два модификатора:

*   Обрезка пробелов с помощью модификатора `-`: удаляет все пробелы (включая переводы строк);
*   Обрезка пробелов строк с помощью модификатора `~`: Удаляет все пробелы (за исключением новых строк). Использование этого модификатора справа отключает удаление по умолчанию первой новой строки, унаследованной от PHP.

Модификаторы можно использовать с любой стороны тегов, например, `{%-` или, `-%}` и они занимают все пробелы для этой стороны тега. Можно использовать модификаторы на одной стороне тега или на обеих сторонах:
```php
    {% set value = 'no spaces' %}
    {#- No leading/trailing whitespace -#}
    {%- if true -%}
        {{- value -}}
    {%- endif -%}
    {# output 'no spaces' #}
    
    <li>
        {{ value }}    </li>
    {# outputs '<li>\n    no spaces    </li>' #}
    
    <li>
        {{- value }}    </li>
    {# outputs '<li>no spaces    </li>' #}
    
    <li>
        {{~ value }}    </li>
    {# outputs '<li>\nno spaces    </li>' #}
```
В дополнение к модификаторам пробелов, Twig также имеет фильтр `spaceless`, который удаляет пробелы между тегами HTML:
```php
    {% apply spaceless %}
        <div>
            <strong>foo bar</strong>
        </div>
    {% endapply %}
    
    {# output will be <div><strong>foo bar</strong></div> #}
```
Метка `apply` была введена в Twig 2.9; используйте тег `filter` с предыдущими версиями.

### Расширения

Twig может быть легко расширен.

Если вы ищете новые теги, фильтры или функции, посмотрите это в официальном хранилище расширений Twig extension repository.

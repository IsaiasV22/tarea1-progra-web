# Laravel Query Builder - Guía para VSCode Copilot

## Descripción General

El **Query Builder** de Laravel permite interactuar con bases de datos mediante una sintaxis fluida y orientada a objetos.
Facilita la construcción de consultas SQL de forma segura, legible y mantenible.

Características principales:

* Prevención automática de **SQL Injection**
* Soporte para múltiples motores de base de datos
* Consultas complejas con sintaxis clara
* Encadenamiento de métodos (Fluent Interface)
* Paginación integrada
* Soporte para transacciones

---

# Acceso a Tablas

```php
use Illuminate\Support\Facades\DB;

$users = DB::table('users')->get();
```

El método principal:

```php
DB::table('table_name')
```

---

# Métodos Encadenables (Fluent Interface)

Permiten construir consultas progresivamente.

```php
$users = DB::table('users')
    ->where('active', 1)
    ->orderBy('name')
    ->limit(10)
    ->get();
```

## Métodos comunes

### Filtrado

```php
where()
orWhere()
whereIn()
whereNull()
```

### Selección

```php
select()
```

### Ordenamiento

```php
orderBy()
```

### Límites

```php
limit()
skip()
take()
```

### Ejecución

```php
get()
first()
count()
paginate()
```

---

# Consultas Condicionales

```php
$query = DB::table('users');

if ($request->has('name')) {
    $query->where('name', $request->name);
}

$users = $query->get();
```

---

# Seguridad contra SQL Injection

Laravel usa:

* Prepared Statements
* Escapado automático de parámetros

Ejemplo seguro:

```php
DB::table('users')
    ->where('email', $request->email)
    ->first();
```

Ejemplo vulnerable:

```php
$email = $_GET['email'];

$user = DB::select(
    "SELECT * FROM users WHERE email = '$email'"
);
```

---

# Joins (Uniones entre tablas)

## INNER JOIN

```php
DB::table('users')
    ->join('orders', 'users.id', '=', 'orders.user_id')
    ->select('users.name', 'orders.total')
    ->get();
```

## LEFT JOIN

```php
leftJoin()
```

## RIGHT JOIN

```php
rightJoin()
```

## CROSS JOIN

```php
crossJoin()
```

---

# Subconsultas

```php
$recentOrders = DB::table('orders')
    ->select('user_id')
    ->groupBy('user_id');

$users = DB::table('users')
    ->joinSub($recentOrders, 'recent_orders', function ($join) {
        $join->on(
            'users.id',
            '=',
            'recent_orders.user_id'
        );
    })
    ->get();
```

---

# UNION

Combina resultados verticalmente.

```php
$activeUsers = DB::table('users')
    ->where('status', 'active');

$inactiveUsers = DB::table('users')
    ->where('status', 'inactive');

$users = $activeUsers
    ->union($inactiveUsers)
    ->get();
```

---

# Agregaciones

```php
count()
sum()
avg()
max()
min()
```

Ejemplo:

```php
$totalUsers = DB::table('users')->count();

$avgAge = DB::table('users')->avg('age');

$maxPrice = DB::table('products')->max('price');
```

---

# groupBy y having

```php
$sales = DB::table('orders')
    ->select('category')
    ->groupBy('category')
    ->get();
```

Filtrar después de agrupar:

```php
->having('total_sales', '>', 1000)
```

---

# Operaciones CRUD

## CREATE

```php
DB::table('users')->insert([
    'name' => 'Carlos',
    'email' => 'carlos@example.com'
]);
```

Insertar múltiples registros:

```php
DB::table('users')->insert([
    ['name' => 'Ana'],
    ['name' => 'Luis']
]);
```

---

## READ

```php
DB::table('users')->get();

DB::table('users')->first();

DB::table('users')->find(1);
```

---

## UPDATE

```php
DB::table('users')
    ->where('id', 1)
    ->update([
        'name' => 'Carlos'
    ]);
```

---

## DELETE

```php
DB::table('users')
    ->where('id', 1)
    ->delete();
```

⚠️ Sin `where()` se afectan TODOS los registros.

---

# Paginación

```php
$users = DB::table('users')
    ->where('active', true)
    ->paginate(10);
```

Alternativa ligera:

```php
simplePaginate()
```

---

# Raw Expressions

Permiten usar SQL directo.

```php
DB::table('users')
    ->select(DB::raw(
        'COUNT(*) as total'
    ))
    ->get();
```

Usar con precaución.

---

# Transacciones

## Forma simple

```php
DB::transaction(function () {

    DB::table('accounts')
        ->where('id', 1)
        ->decrement('balance', 100);

    DB::table('accounts')
        ->where('id', 2)
        ->increment('balance', 100);

});
```

## Forma manual

```php
DB::beginTransaction();

try {

    DB::table('orders')->insert([...]);

    DB::commit();

} catch (\Exception $e) {

    DB::rollBack();

}
```

---

# Debugging de Consultas

## Ver SQL generado

```php
$query = DB::table('users')
    ->where('active', 1)
    ->toSql();
```

## Mostrar consulta y detener ejecución

```php
DB::table('users')
    ->where('active', 1)
    ->dd();
```

---

# Logging de Consultas

```php
DB::enableQueryLog();

DB::table('users')->get();

$queries = DB::getQueryLog();
```

---

# Buenas Prácticas

* Siempre usar `where()` en update y delete
* Evitar concatenar SQL manualmente
* Usar paginación en listas grandes
* Validar datos antes de consultas
* Usar transacciones en operaciones críticas
* Preferir Query Builder sobre SQL crudo

---

# Keywords para Copilot

Laravel
Query Builder
DB::table
CRUD
join
groupBy
having
paginate
transaction
SQL injection
raw queries
aggregation
union
subquery
fluent interface

---

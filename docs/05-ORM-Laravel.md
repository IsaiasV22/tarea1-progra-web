# Guía de Referencia: Eloquent ORM en Laravel

Este documento resume los conceptos clave de **Eloquent ORM** para ser utilizado como contexto por herramientas de autocompletado como VSCode Copilot.

---

# 1. ¿Qué es un ORM?

**ORM (Object-Relational Mapping)** es una técnica que permite interactuar con bases de datos relacionales usando objetos en lugar de SQL directo.

## Beneficios

- Abstracción de la base de datos
- Código más limpio y mantenible
- Seguridad contra SQL Injection
- Portabilidad entre motores de base de datos
- Manejo automático de relaciones

## Desafíos

- Posible pérdida de rendimiento en consultas complejas
- Curva de aprendizaje
- Impedancia objeto-relacional

---

# 2. Eloquent ORM

Eloquent es el ORM oficial de Laravel y utiliza el patrón **Active Record**.

## Patrón Active Record

- Cada modelo representa una tabla
- Cada instancia representa una fila
- El modelo contiene lógica y datos

---

# 3. Estructura Básica de un Modelo

```php
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';

    public $incrementing = true;
    protected $keyType = 'int';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'price',
        'description'
    ];

    protected $guarded = [
        'id',
        'created_at'
    ];

    protected $attributes = [
        'active' => true
    ];

    protected $casts = [
        'price' => 'float',
        'active' => 'boolean',
        'options' => 'array',
        'created_at' => 'datetime'
    ];
}
```

---

# 4. Operaciones CRUD

## Crear

```php
$product = new Product();
$product->name = 'Laptop';
$product->price = 999.99;
$product->save();
```

```php
Product::create([
    'name' => 'Smartphone',
    'price' => 599.99
]);
```

```php
Product::firstOrCreate([
    'name' => 'Tablet'
], [
    'price' => 299.99
]);
```

---

## Leer

```php
Product::all();

Product::find(1);

Product::where('price', '>', 500)->get();

Product::paginate(15);
```

---

## Actualizar

```php
$product = Product::find(1);
$product->price = 899.99;
$product->save();
```

```php
Product::where('active', true)
    ->update(['price' => 799.99]);
```

```php
Product::updateOrCreate(
    ['name' => 'Monitor'],
    ['price' => 199.99]
);
```

---

## Eliminar

```php
$product->delete();

Product::destroy(1);

Product::where('price', '>', 1000)->delete();
```

---

# 5. Soft Deletes

```php
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
}
```

```php
Product::onlyTrashed();

Product::withTrashed()->find(1)->restore();

Product::withTrashed()->find(1)->forceDelete();
```

---

# 6. Relaciones en Eloquent

## Uno a Uno

```php
class User extends Model
{
    public function phone()
    {
        return $this->hasOne(Phone::class);
    }
}

class Phone extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

---

## Uno a Muchos

```php
class Post extends Model
{
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

class Comment extends Model
{
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
```

---

## Muchos a Muchos

```php
class User extends Model
{
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
```

---

## Has Many Through

```php
class Country extends Model
{
    public function posts()
    {
        return $this->hasManyThrough(
            Post::class,
            User::class
        );
    }
}
```

---

# 7. Consultas con Relaciones

```php
User::with('posts')->get();

Post::has('comments')->get();

Post::whereHas('comments', function ($query) {
    $query->where('approved', true);
})->get();
```

---

# 8. Scopes

## Scope Local

```php
class Product extends Model
{
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
```

```php
Product::active()->get();
```

---

# 9. Mutators

Permiten modificar datos antes de guardarlos.

```php
class User extends Model
{
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }
}
```

---

# 10. Accessors

Permiten modificar datos cuando se leen.

```php
class User extends Model
{
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
```

---

# 11. Eventos del Modelo

Eventos disponibles:

- creating
- created
- updating
- updated
- saving
- saved
- deleting
- deleted
- retrieved

## Ejemplo

```php
protected static function booted()
{
    static::creating(function ($product) {
        $product->slug = Str::slug($product->name);
    });
}
```

---

# 12. Observers

```bash
php artisan make:observer ProductObserver --model=Product
```

```php
class ProductObserver
{
    public function created(Product $product)
    {
        // lógica
    }
}
```

Registro en ServiceProvider:

```php
public function boot()
{
    Product::observe(ProductObserver::class);
}
```

---

# 13. Colecciones de Eloquent

```php
$products = Product::all();

$products->pluck('name');

$products->filter();

$products->groupBy('category_id');

$products->sortBy('name');

$products->chunk(10);
```

---

# 14. Transacciones

## Forma recomendada

```php
DB::transaction(function () {
    $user = User::create([...]);

    $user->orders()->create([...]);
});
```

## Forma manual

```php
DB::beginTransaction();

try {

    DB::commit();

} catch (Exception $e) {

    DB::rollBack();

}
```

---

# 15. Consultas Avanzadas

## Subconsultas

```php
Product::select('name')
    ->selectSub(function ($query) {
        $query->selectRaw('count(*)');
    }, 'orders_count')
    ->get();
```

---

## Joins

```php
User::join(
    'posts',
    'users.id',
    '=',
    'posts.user_id'
)->get();
```

---

## Raw Queries

```php
Product::selectRaw(
    'price * ? as price_with_tax',
    [1.21]
)->get();
```

---

# 16. Configuración SQLite en Laravel

## Crear archivo

```bash
touch database/database.sqlite
```

## Configurar .env

```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

---

# 17. Buenas Prácticas

- Usar fillable o guarded
- Evitar consultas N+1 con with()
- Usar transacciones en operaciones críticas
- Preferir relaciones antes que joins manuales
- Usar scopes para lógica reutilizable
- Usar accessors y mutators para consistencia

---

# 18. Palabras Clave Importantes para Copilot

Eloquent
Model
ORM
Active Record
CRUD
Relationships
HasMany
BelongsTo
BelongsToMany
Scope
Accessor
Mutator
Observer
Transaction
Collection
SoftDeletes
SQLite
Query Builder

---

Fin del documento.


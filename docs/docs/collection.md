Collection is a feature of Solital for creating custom data. It will make your life easier by providing personalized data without complexity in your data.

Let's see a quick example:

```php
use Solital\Core\Resource\Collection\ArrayCollection;

$values = [
    ['account_id' => 'account-x10', 'product' => 'Chair'],
    ['account_id' => 'account-x10', 'product' => 'Bookcase'],
    ['account_id' => 'account-x11', 'product' => 'Desk'],
];

$collection = new ArrayCollection($values);

// Or use helper
$collection = collection($values);

$grouped = $collection->groupBy('account_id')->toArray();

pre($grouped);
```

OUTPUT

```php
Array
(
    [account-x10] => Array
        (
            [0] => Array
                (
                    [account_id] => account-x10
                    [product] => Chair
                )

            [1] => Array
                (
                    [account_id] => account-x10
                    [product] => Bookcase
                )

        )

    [account-x11] => Array
        (
            [0] => Array
                (
                    [account_id] => account-x11
                    [product] => Desk
                )

        )

)

```

## `all()`

The all method returns the underlying array represented by the data array:

```php
collection([1, 2, 3])->all();
```

## `avg()`

The avg method returns the average value of a given key:

```php
collection([['foo' => 10], ['foo' => 10], ['foo' => 20], ['foo' => 40]])->avg('foo');
```
Output
```php
20
```
```php
collection([1, 1, 2, 4])->avg();
```
Output
```php
2
```

## `chunk()`

The chunk method breaks  into multiple

```php
collection([1, 2, 3, 4, 5, 6, 7]);
$chunks = $make_data->chunk(4);
$chunks->toArray();
```
Output
```php
 [[1, 2, 3, 4], [5, 6, 7]]
```

## `collapse()`

The collapse method collapses a data array of arrays into a single, flat data array:

```php
collection([[1, 2, 3], [4, 5, 6], [7, 8, 9]]);
$collapsed = $make_data->collapse();
$collapsed->all();
```
Output
```php
[1, 2, 3, 4, 5, 6, 7, 8, 9]
```

## `combine()`

The combine method combines the values of the data array, as keys, with the values of another array or data array:

```php
collection(['name', 'age']);
$combined = $make_data->combine(['George', 29]);
$combined->all();
```
Output
```php
 ['name' => 'George', 'age' => 29]
```

## `concat()`

The concat method appends the given array or data array values onto the end of the data array:

```php
collection(['John Doe']);
$concatenated = $make_data->concat(['Jane Doe'])->concat(['name' => 'Johnny Doe']);
$concatenated->all();
```
Output
```php
 ['John Doe', 'Jane Doe', 'Johnny Doe']
```
## `contains()`
The contains method determines whether the make_data contains a given item:
```php
collection(['name' => 'Desk', 'price' => 100]);
$make_data->contains('Desk');
$make_data->contains('New York');

```
Output
```php
 true 
 false
```
## `count()`
The count method returns the total number of items in the data array:
```php
collection([1, 2, 3, 4]);
$make_data->count();
```
Output
```php
 4
```
## `countBy()`
The countBy method counts the occurences of values in the make_data. By default, the method counts the occurrences of every element:
```php
collection([1, 2, 2, 2, 3]);
$counted = $make_data->countBy();
$counted->all();
```
Output
```php
 [1 => 1, 2 => 3, 3 => 1]
```
## `diff()`
The diff method compares the data array against another data array or a plain PHP array based on its values. This method will return the values in the original data that are not present in the given data array:
```php
collection([1, 2, 3, 4, 5]);
$diff = $make_data->diff([2, 4, 6, 8]);
$diff->all();

```
Output
```php
 [1, 3, 5]
```
## `diffAssoc()`
The diffAssoc method compares the data array against another data array or a plain PHP array based on its keys and values. This method will return the key / value pairs in the original data array that are not present in the given data array:
```php
collection([
    'color' => 'orange',
    'type' => 'fruit',
    'remain' => 6
]);

$diff = $make_data->diffAssoc([
    'color' => 'yellow',
    'type' => 'fruit',
    'remain' => 3,
    'used' => 6
]);

$diff->all();
```
Output
```php
 ['color' => 'orange', 'remain' => 6]
```
## `diffKeys()`
The diffKeys method compares the data array against another data array or a plain PHP array based on its keys. This method will return the key / value pairs in the original data array that are not present in the given data array
```php
collection([
    'one' => 10,
    'two' => 20,
    'three' => 30,
    'four' => 40,
    'five' => 50,
]);

$diff = $diff->diffKeys([
    'two' => 2,
    'four' => 4,
    'six' => 6,
    'eight' => 8,
]);
$diff->all();
```
Output
```php
 ['one' => 10, 'three' => 30, 'five' => 50]
```
## `except()`
The except method returns all items in the data array except for those with the specified keys:
```php
collection(['product_id' => 1, 'price' => 100, 'discount' => false]);
$filtered = $make_data->except(['price', 'discount']);
$filtered->all();
```
Output
```php
 ['product_id' => 1]
```
## `except_multiple()`
The except_multiple method returns all items in the data array except for those with the specified keys:
```php
collection([
    ['product_id' => 1, 'price' => 100, 'discount' => false],
    ['product_id' => 2, 'price' => 500, 'discount' => true]
]);
$filtered = $make_data->except_multiple(['price', 'discount']);
$filtered->all();
```
Output
```php
 Array
 (
     [0] => Array
         (
             [product_id] => 1
         )
 
     [1] => Array
         (
             [product_id] => 2
         )
 
 )
```
## `filter()`
The filter method filters the data array using the given callback, keeping only those items that pass a given truth test:
```php
collection([1, 2, 3, 4]);

$filtered = $make_data->filter(function ($value, $key) {
    return $value > 2;
});
$filtered->all();
```
Output
```php
 [3, 4]
```
## `first()`
The first method returns the first element in the data array that passes a given truth test:
```php
collection([1, 2, 3, 4])->first(function ($value, $key) {
    return $value > 2;
});
```
Output
```php
 3
```
## `firstWhere()`
The firstWhere method returns the first element in the data array with the given key / value pair:
```php
collection([
    ['name' => 'Regena', 'age' => null],
    ['name' => 'Linda', 'age' => 14],
    ['name' => 'Diego', 'age' => 23],
    ['name' => 'Linda', 'age' => 84],
]);
$make_data->firstWhere('name', 'Linda');
```
Output
```php
 ['name' => 'Linda', 'age' => 14]
```
## `flatMap()`
The flatMap method iterates through the data array and passes each value to the given callback. The callback is free to modify the item and return it, thus forming a new data array of modified items. Then, the array is flattened by a level:
```php
collection([
    ['name' => 'Sally'],
    ['school' => 'Arkansas'],
    ['age' => 28]
]);

$flattened = $make_data->flatMap(function ($values) {
    return array_map('strtoupper', $values);
});
$flattened->all();
```
Output
```php
 ['name' => 'SALLY', 'school' => 'ARKANSAS', 'age' => '28'];
```
## `flatten()`
The flatten method flattens a multi-dimensional data array into a single dimension:
```php
collection(['name' => 'jony', 'languages' => ['php', 'javascript']]);
$flattened = $make_data->flatten();
$flattened->all();
```
Output
```php
 ['jony', 'php', 'javascript'];
```
## `flip()`
The flip method swaps the data arrays's keys with their corresponding values:
```php
collection(['name' => 'Jony', 'library' => 'array_master']);
$flipped = $make_data->flip();
$flipped->all();
```
Output
```php
 ['jony' => 'name', 'array_master' => 'library']
```
## `forget()`
The forget method removes an item from the data array by its key:
```php
collection(['name' => 'Jony', 'library' => 'array_master']);
$make_data->forget('name');
$make_data->all();


```
Output
```php
  ['library' => 'array_master']
```
## `get()`
The get method returns the item at a given key. If the key does not exist, null is returned:
```php
collection(['name' => 'Jony', 'library' => 'array_master']);
$value = $make_data->get('name');
```
Output
```php
 Jony
```
## `groupBy()`
The groupBy method groups the data arrays's items by a given key:
```php
collection([
    ['account_id' => 'account-x10', 'product' => 'Chair'],
    ['account_id' => 'account-x10', 'product' => 'Bookcase'],
    ['account_id' => 'account-x11', 'product' => 'Desk'],
]);
$grouped = $make_data->groupBy('account_id');
$grouped->toArray();

```
Output
```php
  [
         'account-x10' => [
             ['account_id' => 'account-x10', 'product' => 'Chair'],
             ['account_id' => 'account-x10', 'product' => 'Bookcase'],
         ],
         'account-x11' => [
             ['account_id' => 'account-x11', 'product' => 'Desk'],
         ],
     ]
```
## `has()`
The has method determines if a given key exists in the data array:
```php
collection(['account_id' => 1, 'product' => 'Desk', 'amount' => 5]);
$make_data->has('product');

```
Output
```php
 true
```
## `implode()`
The implode method joins the items in a dara array. Its arguments depend on the type of items in the dara array. If the data array contains arrays or objects, you should pass the key of the attributes you wish to join, and the "glue" string you wish to place between the values:
```php
collection([
    ['account_id' => 1, 'product' => 'Desk'],
    ['account_id' => 2, 'product' => 'Chair'],
]);
$make_data->implode('product', ', ');

```
Output
```php
Desk, Chair
 
```
## `intersect()`
The intersect method removes any values from the original data array that are not present in the given array or dara array. The resulting data array will preserve the original dara array's keys:
```php
collection(['Desk', 'Sofa', 'Chair']);
$intersect = $make_data->intersect(['Desk', 'Chair', 'Bookcase']);
$intersect->all();

```
Output
```php
 [0 => 'Desk', 2 => 'Chair']
```
## `intersectByKeys()`
The intersectByKeys method removes any keys from the original data array that are not present in the given array or dara array:
```php
collection([
    'serial' => 'UX301', 'type' => 'screen', 'year' => 2009
]);
$intersect = $make_data->intersectByKeys([
    'reference' => 'UX404', 'type' => 'tab', 'year' => 2011
]);

$intersect->all();
```
Output
```php
 ['type' => 'screen', 'year' => 2009]
```
## `isEmpty()`
The isEmpty method returns true if the data array is empty; otherwise, false is returned:
```php
collection([])->isEmpty();
```
Output
```php
 true
```
## `isNotEmpty()`
The isNotEmpty method returns true if the data array is not empty; otherwise, false is returned:
```php
collection([])->isNotEmpty();
```
Output
```php
 false
```

## `keyBy()`
The keyBy method keys the data array by the given key. If multiple items have the same key, only the last one will appear in the new dara array:
```php
collection([
    ['product_id' => 'prod-100', 'name' => 'Desk'],
    ['product_id' => 'prod-200', 'name' => 'Chair'],
]);
$keyed = $make_data->keyBy('product_id');
$keyed->all();
```
Output
```php
 [
         'prod-100' => ['product_id' => 'prod-100', 'name' => 'Desk'],
         'prod-200' => ['product_id' => 'prod-200', 'name' => 'Chair'],
     ]
```
## `keys()`
The keys method returns all of the data array's keys:
```php
collection([
    'prod-100' => ['product_id' => 'prod-100', 'name' => 'Desk'],
    'prod-200' => ['product_id' => 'prod-200', 'name' => 'Chair'],
]);
$keys = $make_data->keys();
```
Output
```php
 ['prod-100', 'prod-200']
```
## `last()`
The last method returns the last element in the data array that passes a given truth test:
```php
collection([1, 2, 3, 4])->last();

```
Output
```php
4
```
## `map()`
The map method iterates through the data array and passes each value to the given callback. The callback is free to modify the item and return it, thus forming a new data array of modified items:
```php
collection([1, 2, 3, 4, 5]);

$multiplied = $make_data->map(function ($item, $key) {
    return $item * 2;
});
$multiplied->all();
```
Output
```php
  [2, 4, 6, 8, 10]
```
## `mapWithKeys()`

```php
collection([
    [
        'name' => 'John',
        'department' => 'Sales',
        'email' => 'john@example.com'
    ],
    [
        'name' => 'Jane',
        'department' => 'Marketing',
        'email' => 'jane@example.com'
    ]
]);

$keyed = $make_data->mapWithKeys(function ($item) {
    return [$item['email'] => $item['name']];
});

$keyed->all();
```
Output
```php
 [
         'john@example.com' => 'John',
         'jane@example.com' => 'Jane',
     ]
```
## `max()`
The max method returns the maximum value of a given key:

```php
collection([['foo' => 10], ['foo' => 20]])->max('foo');
collection([['foo' => 10], ['foo' => 30]])->max('foo');

```
Output
```php
 20
 30
```
## `median()`
The median method returns the median value of a given key:
```php
collection([['foo' => 10], ['foo' => 10], ['foo' => 20], ['foo' => 40]])->median('foo');

```
Output
```php
 15
```
## `merge()`
```php
collection(['product_id' => 1, 'price' => 100]);
$merged = $make_data->merge(['price' => 200, 'discount' => false]);
$merged->all();
```
Output
```php
 ['product_id' => 1, 'price' => 200, 'discount' => false]
```
## `min()`
The min method returns the minimum value of a given key:
```php
collection([['foo' => 10], ['foo' => 20]])->min('foo');
collection([1, 2, 3, 4, 5])->min();

```
Output
```php
 10
 1
```
## `mode()`
The mode method returns the mode value of a given key:
```php
collection([['foo' => 10], ['foo' => 10], ['foo' => 20], ['foo' => 40]])->mode('foo');
collection([1, 1, 2, 4])->mode();
```
Output
```php
 [10]
 [1]
```
## `only()`
The only method returns the items in the data array with the specified keys:
```php
collection(['product_id' => 1, 'name' => 'Desk', 'price' => 100, 'discount' => false]);

$filtered = $make_data->only(['product_id', 'name']);

$filtered->all();
```
Output
```php
 ['product_id' => 1, 'name' => 'Desk']
```
## `pad()`
```php
collection(['A', 'B', 'C']);

$filtered = $make_data->pad(5, 0);

$filtered->all();

```
Output
```php
 ['A', 'B', 'C', 0, 0]
```
## `partition()`
The partition method may be combined with the list PHP function to separate elements that pass a given truth test from those that do not:
```php
collection([1, 2, 3, 4, 5, 6]);

list($underThree, $equalOrAboveThree) = $make_data->partition(function ($i) {
    return $i < 3;
});

$underThree->all();
$equalOrAboveThree->all();

```
Output
```php
 [1, 2]
 [3, 4, 5, 6]
 
```
## `pipe()`
The pipe method passes the data array to the given callback and returns the result:
```php
collection([1, 2, 3]);

$piped = $make_data->pipe(function ($make_data) {
    return $make_data->sum();
});
```
Output
```php
 6
```
## `pluck()`
The pluck method retrieves all of the values for a given key:
```php
collection([
    ['product_id' => 'prod-100', 'name' => 'Desk'],
    ['product_id' => 'prod-200', 'name' => 'Chair'],
]);

$plucked = $make_data->pluck('name');

$plucked->all();
```
Output
```php
 ['Desk', 'Chair']
```
## `pop()`
The pop method removes and returns the last item from the data array:
```php
collection([1, 2, 3, 4, 5]);
$make_data->pop();
$make_data->all();
```
Output
```php
 5
 [1, 2, 3, 4]
```
## `prepend()`
The prepend method adds an item to the beginning of the data array:

```php
collection([1, 2, 3, 4, 5]);

$make_data->prepend(0);

$make_data->all();

```
Output
```php
 [0, 1, 2, 3, 4, 5]
```
## `pull()`
The pull method removes and returns an item from the data array by its key:

```php
collection(['product_id' => 'prod-100', 'name' => 'Desk']);
$make_data->pull('name');
$make_data->all();


```
Output
```php
 'Desk'
 ['product_id' => 'prod-100']
```
## `push()`
The push method appends an item to the end of the data array:
```php
collection([1, 2, 3, 4]);
$make_data->push(5);
$make_data->all();
```
Output
```php
 [1, 2, 3, 4, 5]
```
## `put()`
The put method sets the given key and value in the data array:
```php
collection(['product_id' => 1, 'name' => 'Desk']);
$make_data->put('price', 100);
$make_data->all();
```
Output
```php
 ['product_id' => 1, 'name' => 'Desk', 'price' => 100]
```
## `random()`
The random method returns a random item from the data array:
```php
collection([1, 2, 3, 4, 5]);
$make_data->random();
```
Output
```php
 4 - (retrieved randomly)
```
## `reduce()`
The reduce method reduces the data array to a single value, passing the result of each iteration into the subsequent iteration:
```php
collection([1, 2, 3]);

$total = $make_data->reduce(function ($carry, $item) {
    return $carry + $item;
});

```
Output
```php
 6
```
## `reject()`
The reject method filters the data array using the given callback. The callback should return true if the item should be removed from the resulting data array:
```php
collection([1, 2, 3, 4]);

$filtered = $make_data->reject(function ($value, $key) {
    return $value > 2;
});

$filtered->all();
```
Output
```php
 [1, 2]
```
## `reverse()`
The reverse method reverses the order of the data array's items, preserving the original keys:

```php
collection(['a', 'b', 'c', 'd', 'e']);

$reversed = $make_data->reverse();

$reversed->all();

```
Output
```php
 [
         4 => 'e',
         3 => 'd',
         2 => 'c',
         1 => 'b',
         0 => 'a',
     ]
```
## `search()`
The search method searches the data array for the given value and returns its key if found. If the item is not found, false is returned.
```php
collection([2, 4, 6, 8]);

$make_data->search(4);
```
Output
```php
 1
```
## `shift()`
The shift method removes and returns the first item from the data array:
```php
collection([1, 2, 3, 4, 5]);
$make_data->shift();
$make_data->all();
```
Output
```php
1
 [2, 3, 4, 5]
```
## `shuffle()`
The shuffle method randomly shuffles the items in the data array:
```php
collection([1, 2, 3, 4, 5]);

$shuffled = $make_data->shuffle();

$shuffled->all();

```
Output
```php
 [3, 2, 5, 1, 4] - (generated randomly)
```
## `slice()`
The slice method returns a slice of the data array starting at the given index:

```php
collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

$slice = $make_data->slice(4);

$slice->all();
```
Output
```php
 [5, 6, 7, 8, 9, 10]
```
## `sort()`
The sort method sorts the data array. The sorted data array keeps the original array keys, so in this example we'll use the values method to reset the keys to consecutively numbered indexes:
```php
collection([5, 3, 1, 2, 4]);

$sorted = $make_data->sort();

$sorted->values()->all();
```
Output
```php
 [1, 2, 3, 4, 5]
```
## `sortBy()`
```php
collection([
    ['name' => 'Desk', 'price' => 200],
    ['name' => 'Chair', 'price' => 100],
    ['name' => 'Bookcase', 'price' => 150],
]);

$sorted = $make_data->sortBy('price');

$sorted->values()->all();
```
Output
```php
 [
         ['name' => 'Chair', 'price' => 100],
         ['name' => 'Bookcase', 'price' => 150],
         ['name' => 'Desk', 'price' => 200],
     ]
```
##`sortByDesc()`
```
This method has the same signature as the sortBy method, but will sort the collection in the opposite order.
```
## `sortKeys()`
The sortKeys method sorts the data array by the keys of the underlying associative array:
```php
collection([
    'id' => 22345,
    'first' => 'John',
    'last' => 'Doe',
]);

$sorted = $make_data->sortKeys();

$sorted->all();
```
Output
```php
  [
         'first' => 'John',
         'id' => 22345,
         'last' => 'Doe',
     ]
```
## `splice()`
The splice method removes and returns a slice of items starting at the specified index:
```php
collection([1, 2, 3, 4, 5]);

$chunk = $make_data->splice(2);

$chunk->all();
```
Output
```php
 [3, 4, 5]
```
## `split()`
The split method breaks a data array into the given number of groups:

```php
collection([1, 2, 3, 4, 5]);

$groups = $make_data->split(3);

$groups->toArray();
```
Output
```php
 [[1, 2], [3, 4], [5]]
```
## `sum()`
The sum method returns the sum of all items in the data array:
```php
.............................
collection([1, 2, 3, 4, 5])->sum();
.............................
collection([
    ['name' => 'JavaScript: The Good Parts', 'pages' => 176],
    ['name' => 'JavaScript: The Definitive Guide', 'pages' => 1096],
]);

$make_data->sum('pages');
.............................

collection([
    ['name' => 'Chair', 'colors' => ['Black']],
    ['name' => 'Desk', 'colors' => ['Black', 'Mahogany']],
    ['name' => 'Bookcase', 'colors' => ['Red', 'Beige', 'Brown']],
]);

$make_data->sum(function ($product) {
    return count($product['colors']);
});
```
Output
```php
 15
 1272
 6
```
## `take()`
The take method returns a new data array with the specified number of items:
```php
collection([0, 1, 2, 3, 4, 5]);

$chunk = $make_data->take(3);

$chunk->all();
```
Output
```php
 [0, 1, 2]
```
## `tap()`
The tap method passes the data array to the given callback, allowing you to "tap" into the data array at a specific point and do something with the items while not affecting the data array itself:
```php
collection([2, 4, 3, 1, 5])
    ->sort()
    ->tap(function ($make_data) {
        Log::debug('Values after sorting', $make_data->values()->toArray());
    })
    ->shift();
```
Output
```php
 1
```
## `times()`
The static times method creates a new data array by invoking the callback a given amount of times:
```php
$make_data = Collection::times(10, function ($number) {
    return $number * 9;
});

$make_data->all();
```
Output
```php
 [9, 18, 27, 36, 45, 54, 63, 72, 81, 90]
```
## `toJson()`
The toJson method converts the data array into a JSON serialized string:
```php
collection(['name' => 'Desk', 'price' => 200]);

$make_data->toJson();
```
Output
```php
 '{"name":"Desk", "price":200}'
```
## `transform()`
The transform method iterates over the data array and calls the given callback with each item in the data array. The items in the data array will be replaced by the values returned by the callback:
```php
collection([1, 2, 3, 4, 5]);

$make_data->transform(function ($item, $key) {
    return $item * 2;
});

$make_data->all();
```
Output
```php
 [2, 4, 6, 8, 10]
```
## `union()`
union()

The union method adds the given array to the data array. If the given array contains keys that are already in the original data array, the original data array's values will be preferred:
```php
collection([1 => ['a'], 2 => ['b']]);

$union = $make_data->union([3 => ['c'], 1 => ['b']]);

$union->all();

```
Output
```php
 [1 => ['a'], 2 => ['b'], 3 => ['c']]
```
## `unique()`
The only method returns the items in the data array with the specified keys:
```php
collection([1, 1, 2, 2, 3, 4, 2]);

$unique = $make_data->unique();

$unique->values()->all();

collection([
    ['name' => 'iPhone 6', 'brand' => 'Apple', 'type' => 'phone'],
    ['name' => 'iPhone 5', 'brand' => 'Apple', 'type' => 'phone'],
    ['name' => 'Apple Watch', 'brand' => 'Apple', 'type' => 'watch'],
    ['name' => 'Galaxy S6', 'brand' => 'Samsung', 'type' => 'phone'],
    ['name' => 'Galaxy Gear', 'brand' => 'Samsung', 'type' => 'watch'],
]);

$unique = $make_data->unique('brand');

$unique->values()->all();
```
Output
```php
 [1, 2, 3, 4]
  [
         ['name' => 'iPhone 6', 'brand' => 'Apple', 'type' => 'phone'],
         ['name' => 'Galaxy S6', 'brand' => 'Samsung', 'type' => 'phone'],
     ]
```
## `unless()`
The unless method will execute the given callback unless the first argument given to the method evaluates to true:
```php
collection([1, 2, 3]);

$make_data->unless(true, function ($make_data) {
    return $make_data->push(4);
});

$make_data->unless(false, function ($make_data) {
    return $make_data->push(5);
});

$make_data->all();
```
Output
```php
 [1, 2, 3, 5]
```
## `values()`
The values method returns a new data array with the keys reset to consecutive integers:
```php
collection([
    10 => ['product' => 'Desk', 'price' => 200],
    11 => ['product' => 'Desk', 'price' => 200]
]);

$values = $make_data->values();

$values->all();
```
Output
```php
 [
         0 => ['product' => 'Desk', 'price' => 200],
         1 => ['product' => 'Desk', 'price' => 200],
     ]
```
## `when()`
The when method will execute the given callback when the first argument given to the method evaluates to true:
```php
collection([1, 2, 3]);

$make_data->when(true, function ($make_data) {
    return $make_data->push(4);
});

$make_data->when(false, function ($make_data) {
    return $make_data->push(5);
});

$make_data->all();
```
Output
```php
  [1, 2, 3, 4]
```
## `whenEmpty()`
The whenEmpty method will execute the given callback when the data array is empty:
```php
collection(['michael', 'tom']);

$make_data->whenEmpty(function ($make_data) {
    return $make_data->push('adam');
});

$make_data->all();

// ['michael', 'tom']

$make_data = make_data);

$make_data->whenEmpty(function ($make_data) {
    return $make_data->push('adam');
});

$make_data->all();
```
Output
```php
 ['adam']
```
## `whenNotEmpty()`
The whenNotEmpty method will execute the given callback when the data array is not empty:
```php
collection(['michael', 'tom']);

$make_data->whenNotEmpty(function ($make_data) {
    return $make_data->push('adam');
});

$make_data->all();
```
Output
```php
 ['michael', 'tom', 'adam']
```
## `where()`
The where method filters the data array by a given key / value pair:
```php
collection([
    ['product' => 'Desk', 'price' => 200],
    ['product' => 'Chair', 'price' => 100],
    ['product' => 'Bookcase', 'price' => 150],
    ['product' => 'Door', 'price' => 100],
]);

$filtered = $make_data->where('price', 100);

$filtered->all();
```
Output
```php
 [
         ['product' => 'Chair', 'price' => 100],
         ['product' => 'Door', 'price' => 100],
     ]
```
## `whereBetween()`
The whereBetween method filters the data array within a given range:

```php
collection([
    ['product' => 'Desk', 'price' => 200],
    ['product' => 'Chair', 'price' => 80],
    ['product' => 'Bookcase', 'price' => 150],
    ['product' => 'Pencil', 'price' => 30],
    ['product' => 'Door', 'price' => 100],
]);

$filtered = $make_data->whereBetween('price', [100, 200]);

$filtered->all();
```
Output
```php
 [
         ['product' => 'Desk', 'price' => 200],
         ['product' => 'Bookcase', 'price' => 150],
         ['product' => 'Door', 'price' => 100],
     ]
```
## `whereIn()`
The whereIn method filters the data array by a given key / value contained within the given array:
```php
collection([
    ['product' => 'Desk', 'price' => 200],
    ['product' => 'Chair', 'price' => 100],
    ['product' => 'Bookcase', 'price' => 150],
    ['product' => 'Door', 'price' => 100],
]);

$filtered = $make_data->whereIn('price', [150, 200]);

$filtered->all();
```
Output
```php
 [
         ['product' => 'Bookcase', 'price' => 150],
         ['product' => 'Desk', 'price' => 200],
     ]
```
## `whereNotBetween()`
The whereNotBetween method filters the data array within a given range:
```php
collection([
    ['product' => 'Desk', 'price' => 200],
    ['product' => 'Chair', 'price' => 80],
    ['product' => 'Bookcase', 'price' => 150],
    ['product' => 'Pencil', 'price' => 30],
    ['product' => 'Door', 'price' => 100],
]);

$filtered = $make_data->whereNotBetween('price', [100, 200]);

$filtered->all();
```
Output
```php
 [
         ['product' => 'Chair', 'price' => 80],
         ['product' => 'Pencil', 'price' => 30],
     ]
```
## `whereNotIn()`
The whereNotIn method filters the data array by a given key / value not contained within the given array:
```php
collection([
    ['product' => 'Desk', 'price' => 200],
    ['product' => 'Chair', 'price' => 100],
    ['product' => 'Bookcase', 'price' => 150],
    ['product' => 'Door', 'price' => 100],
]);

$filtered = $make_data->whereNotIn('price', [150, 200]);

$filtered->all();
```
Output
```php
 ['product_id' => 1, 'name' => 'Desk']
```
## `wrap()`
The static wrap method wraps the given value in a data array when applicable:
```php
$make_data = Collection::wrap('John Doe');
$make_data->all();

```
Output
```php
  ['John Doe']
```
## `zip()`
The zip method merges together the values of the given array with the values of the original data array at the corresponding index:
```php
collection(['Chair', 'Desk']);

$zipped = $make_data->zip([100, 200]);

$zipped->all();
```
Output
```php
 [['Chair', 100], ['Desk', 200]]
```

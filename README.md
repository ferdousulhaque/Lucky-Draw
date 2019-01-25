# Lucky Draw

This class takes an example array (format is given in example file, will also be explained below) and generates Item and Item count for winners.

> Please don't use this to generate things/prizes with People's hard earned money. It is intended to make things fun with bonus gifts only.

## Prerequisits

Language: PHP 7+

## Usage

### Input Data

```php
[
    [
        'item' => 'product_code_000_NoLuck',  // Item code or Identifier
        'chances' => '100000',                // Item Chances
        'amounts '=> [ 1 ]                      // Item Amounts
    ],
    [
        'item' => 'product_code_001',
        'chances' => '1000',
        'amounts' => [ rand(1,100) ]            // Random Value passing
    ],
    [
        'item' => 'product_code_002',
        'chances' => '500.001',               // Fraction Allowed
        'amounts' => [
            1 => 100,                         // Amount chances
            5 => 50,                          // Format: Amount => Chances
            10 => 10,                         // Fraction Not allowed
            rand(50,60) => 1,                 // Random Value in Amount
        ]
    ],
    [
        'item' => 'product_code_004',
        'chances' => '1',
        'amounts' => [ 10, 15, 30, 50 ]            // Amount without probability
    ],
]
```
- **item**: Provide your item's unique identifier
- **chances**: Weight of item. 
    - It will be compared along all the items in array. 
    - The higher the chances the greater the chances of getting the item.
    - Fraction number supported
    - In case of active inventory we can pass available item stock here
- **amounts**: Array of Item amount. It can be any like following:
    - Single Value, i.e. [ 1 ] or random single value, i.e. [ 1-100 ]
    - Fraction number not supported
    - Can be weighted amount, i.e.    
        ```php
        [
            5 => 100,
            15 => 50,
            50 => 10,
            80 => 5
        ]
        ```      
    - We can also pass random single value, i.e. [ 50-100 ] in above amount part using rand() or mt_rand().       
        ```php
        [
            1 => 100,
            5  => 50,
            10 => 10,
            rand(50,100) => 5
        ]
        ```
    - Or can be selective amount for random pick
         ```php
        [ 10, 15, 30, 50, 90]
        ```

### Output Data

```markdown
product_code_000_NoLuck (1)                 // Item Code and Amount
```

```php
list( $p, $c ) = luckyDraw::get($prizes);
```

- We will pass the Formatted Input i.e. $prizes
- From above example, (after execution) $p will be the Item Code and $c will be the item count.

## Risks & Solutions

There is some risks regarding the generation.
- Available Stock should be passed (after subtracting used amount from stock amount) in chances properly.
- If Available Stock become Nil, it is better to remove it from the array. Also setting chances to 0 (zero) will work too.

## Support

Having trouble? Create an issue!

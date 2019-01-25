# Lucky Draw

This class takes an example array (format is given in example file, will also be explained below) and generates Item and Item count for winners.

## Caution

Please don't use this to generate things/prizes for People's hard earned money. It is only intended to make things fun with bonus gifts only.

## Prerequisits

Language: PHP 7+

### Input Data

```php
    [
        [
            'item'=>'product_code_000_NoLuck',  // Item code or Identifier
            'chances'=>'100000',                // Item Chances
            'amounts'=>[1]                      // Item Amounts
        ],
        [
            'item'=>'product_code_001',
            'chances'=>'1000',
            'amounts'=>[rand(1,100)]            // Random Value passing
        ],
        [
            'item'=>'product_code_002',
            'chances'=>'500.001',               // Fraction Allowed
            'amounts'=>[
                1=>100,                         // Amount chances
                5=>50,                          // Format: Amount => Chances
                10=>10,                         // Fraction Not allowed
                rand(50-60)=>1,                 // Random Value in Amount
            ]
        ],
        [
            'item'=>'product_code_004',
            'chances'=>'1',
            'amounts'=>[1]
        ],
    ]
```
- **item**: Provide your item's unique identifier
- **chances**: Weight of item. 
    --It will be compared along all the items in array. 
    --The higher the chances the greater the chances of getting the item.
    --Fraction number supported
    --In case of active inventory we can pass available item stock here
    --For “No Luck” part we can set a bigger value (As in Chewn Chewn we have MyTelenor total probable coupon amounts)
- **amounts**: Array of Item amount. It can be any like following:
    --Single Value, i.e. [ 1 ] or random single value, i.e. [ 1-100 ]
    --Fraction number not supported
    --Can be weighted amount, i.e.
        ```php
        [
            rand(1-10)=>100,    // Here Amount => Chance
            15=>50,
            50=>10,
            rand(61-200)=>5
        ]
        ```
        ```php
        [1=>100,5=>50,10=>10,20=>5]
        ```
    --We can also pass random single value, i.e. [ 1-100 ] in above amount part.

### Output Data

```markdown
product_code_000_NoLuck (1)                 // Item Code and Amount
```

```php
list($p,$c)=luckyDraw::get($prizes);
```

- We will pass the Formatted Input i.e. $prizes
- From above example, (after execution) $p will be the Item Code and $c will be the item count.

## Risks & Solutions

There is some risks regarding the generation.
- Available Stock should be passed (after subtracting used amount from stock amount) in chances properly.
- If Available Stock become Nil, it is better to remove it from the array. Also setting chances to 0 (zero) will work too.

### Support

Having trouble? Create an issue!

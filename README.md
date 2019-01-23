## Lucky Draw

This class takes an example array (format is given in example file, will also be explained below) and generates Item and Item count for winners.

### Caution

Please don't use this to generate things/prizes for People's hard earned money. It is only intended to make things fun with bonus gifts only.

### Prerequisits

Language: PHP 7.2+

### Input Data

```markdown
$prizes=
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
    ];
```

### Output Data

```markdown
    product_code_000_NoLuck (1)                 // Item Code and Amount
```

### Usage
- **item**: Provide your item's unique identifier
- **chances**: Weight of item (fraction Supported). It will be compared along all the items in array. The higher the chances the greater the chances of getting the item.
- **amounts**: Array of Item amount. It can be a (randomized/single) value or can be a array like,
```markdown
    'amounts'=> [
        rand(1-10)=>100,
        rand(11-30)=>50,
        rand(31-60)=>10,
        rand(61-200)=>5
    ]
```
```markdown
    'amounts'=>[1=>100,5=>50,10=>10,20=>5]
```
in above amount example, keys mean the item count and the values mean the probability (fraction not supported).

#### Getting/Processing the Result
```markdown
list($p,$c)=luckyDraw::get($prizes);
```

From above example, _$p_ will be the Item Code and _$c_ will be the item count.

### Support

Having trouble? Create an issue!

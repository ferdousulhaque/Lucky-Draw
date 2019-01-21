## Lucky Draw

This class takes an example array (format is given in example file, will also be explained below) and generates Item and Item count for winners.

### Caution

Please don't use this to generate things/prizes for People's hard earned money. It is only intended to make things fun with bonus gifts only.

### Usage

Example available in example.php file.

```markdown
    'item'=> 874545,
    'chances'=> 1,
    'amounts'=> [rand(1,100)]
```

- **item**: Provide your item's unique identifier
- **chances**: Weight of item(Fraction Supported). It will be compared along all the items in array. The higher the chances the greater the chances of getting the item.
- **amounts**: Array of Item amount. It can be a (randomized/single) value or can be a array like,
```markdown
    'amounts'=>[
        rand(1-10)=>100,
        rand(11-30)=>50,
        rand(31-60)=>10,
        rand(61-200)=>5
    ]
```
```markdown
    'amounts'=>[1=>100,5=>50,10=>10,20=>5]
```
in above amount example, keys mean the item count and the values mean the probability(fraction not supported).

#### Getting/Processing the Result
```markdown
list($p,$c)=luckyDraw::get($prizes);
```

From above example, _$p_ will be the Item Code and _$c_ will be the item count.

### Support

Having trouble? Create an issue!

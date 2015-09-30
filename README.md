# Color Found
Find a basic color name from a HEX code

For an ecommerce store, I need a tool to convert a hex code from product image to a pre-defined basic color in my store. I look for the solution of this task and I found the basic alogrithm to handle this conversion.

**Alogrithm**

1/ Convert the HEX Code to RGB Value

2/ Calculate the distance between current color with other colors by using this formula:

Color 1 RGB Value: Red1, Green1, Blue 1
Color 2 RGB Value: Red2, Green2, Blue 2

=> Distance = sqrt((Red2-Red1)^2+(Green2-Green1)^2+(Blue2-Blue1)^2)

3/ Get the color with the smallest distance

**Example**

```
<?php

require_once('ColorFound.php');

$colorFound = new ColorFound;
echo $colorFound->getName("#66a85a"); 
// It will return 'green' based on the defined Base Colors

```

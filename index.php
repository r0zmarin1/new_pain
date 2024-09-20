<?php
if(!empty($_GET['product']))
{
    foreach($_GET['product'] as $k => $v)
        echo "$k : $v <br>";

    echo $_GET['product']['name'];
}
else
{
    echo 'Product не отправился';
}
?>

<form>
    <p>
        name
        <input type="text" name="product[name]">
    </p>
    <p>
        article
        <input type="text" name="product[article]">
    </p>
    <p>
        price
        <input type="text" name="product[price]">
    </p>
    <input type="submit">
</form>
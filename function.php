<?php
if(isset($_POST['form'])) {
    echo $_POST['title'] . '<br>';
}
else {
    echo 'Форма не отправлена';
}
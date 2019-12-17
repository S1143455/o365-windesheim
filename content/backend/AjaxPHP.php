<?php
function test(){
    alert('testPHP');
}

if(isset($_POST['function2call']) && !empty($_POST['function2call'])) {
    $function2call = $_POST['function2call'];
    switch($function2call) {
        case 'getEmployeesList' : test();break;
        case 'other' : // do something;break;
            // other cases
    }
}
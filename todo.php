<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TODO</title>
</head>
<body>
<h1>Cписок дел</h1>
<form method="post">
    <input name="add" value="Test">
    <input type="submit" name="OK">
</form>
<table border="1">
    <tr>
        <td>
            Описание задачи
        </td>
        <td>
            Дата добавления
        </td>
        <td>
            Статус
        </td>
        <td>
            Функции
        </td>
    </tr>
    <?php
    error_reporting(E_ERROR);
    header("Content-Type: text/html; charset=utf-8");
    $db = mysqli_connect("localhost", "rooting", "123123", "firstDataBase");
    mysqli_set_charset($db, 'utf-8');
    $query = 'select * from tasks';
    $res = mysqli_query($db, $query);
    $add = $_POST['add'];

    $n=0;
    if  (isset($_POST['OK'])){

    $queryAdd = "INSERT INTO `tasks`( description, is_done,date_added) VALUES ('$add',0,'".date('Y.m.d G.i.s')."')";

    mysqli_query($db, $queryAdd);
    }
    while ($data = mysqli_fetch_array($res)) {
        $array[] = $data;

     if (isset($_POST['Fail'])){
         $queryFail = "UPDATE tasks SET is_done = 0 WHERE tasks.id=".$array[$n]['id'];
         mysqli_query($db,$queryFail);


 }
 if (isset($_POST['Complete'])){
     $queryComplete = "UPDATE tasks SET is_done = 1 WHERE tasks.id=".$array[$n]['id'];
     mysqli_query($db,$queryComplete);
         
 }
 if (isset($_POST['Delete'])){
     $queryComplete = "DELETE FROM `tasks` WHERE id =".$array[$n]['id'];
     mysqli_query($db,$queryComplete);
         $data['is_done'] = 1;
 }

     if ($data['is_done'] == 1) {
     $flag = 'Выполнено';
 }else{
     $flag ='В процессе';
 }
     echo
     "<tr><td>",$data['description'],
     "</td><td>",$data['date_added'],
     "</td><td>",$flag,
     "<form method='post'></td><td><input type='submit' name='Complete' value='Выполнил'>
     <input type='submit' name='Fail' value='Не выполнил'>
     <input type='submit' name='Delete' value='Удалить'>",
     "</td></tr>";
    $n++;


 }
    ?>
</table>
</body>
</html>
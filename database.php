<?php

    function exec_query($sql)
    {
        include "connection.php";
        $result = pg_query($conn, $sql);
        return $result;
    }

    function fetch_assoc($sql)
    {
        $res = exec_query($sql);
        return pg_fetch_assoc($res);
    }

    function fetch_all($sql)
    {
        $res = exec_query($sql);
        return pg_fetch_all($res);
    }

?>
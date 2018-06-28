<?php


if ((substr($_SERVER['REQUEST_URI'],0,5) === "/api/")
    || (substr($_SERVER['REQUEST_URI'],0,6) === "/rest/"))
{
    include "../skWeb.php";
} else {
    include "ReactJS/dist/index.html";
}

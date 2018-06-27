<?php
if (substr($_SERVER['REQUEST_URI'],0,5)==="/api/") {
    $_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'],4);
    include "../skAPI.php";
} else {
    include "ReactJS/dist/index.html";
}

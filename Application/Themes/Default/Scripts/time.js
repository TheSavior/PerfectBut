<?php
header("Content-type: application/x-javascript");
?>

"use strict";
    
function formatDate(timestamp) {
    var extra = "";
    var time = Math.round((new Date()).getTime() / 1000);
    
    var diff = time - timestamp;
    
    if (diff < 60) {
        return "just now";
    }
    else if (diff < 60 * 60) {
        var result = Math.floor(diff/60);
        var plrl = plural(result);
        return result+" minute"+plrl+" ago";
    }
    else if (diff < 60 * 60 * 24) {
        var result = Math.floor(diff / (60 * 60));
        var plrl = plural(result);
        return result+" hour"+plrl+" ago";
    }
    else if (diff < 60 * 60 * 24 * 30) {
        var result = Math.floor(diff / (60 * 60 * 24));
        var plrl = plural(result)
        return result+" day"+plrl+" ago";
    }
    
    var result = Math.floor(diff / (60 * 60 * 24 * 30));
    var plrl = plural(result);
    return result+" month"+plrl+" ago";
}
    
function plural(num) {
     if (num != 1) {
         return "s";
     }            
     else
     {
         return "";
     }     
}
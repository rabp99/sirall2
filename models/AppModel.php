<!-- File: /models/AppModel.php -->

<?php
    interface AppModel {
        function toArray();
        function toXML();
        function toJSON();
        function toString();
    }
?>

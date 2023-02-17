<?php
    interface RESTfulInterface{
        public function restGet($params);
        public function restPut($params,$key);
        public function restPost($params,$key);
        public function restDelete($params);
    }

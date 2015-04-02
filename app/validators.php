<?php
Validator::resolver(function($translator, $data, $rules, $messages)
{
    return new CCValidator($translator, $data, $rules, $messages);
});
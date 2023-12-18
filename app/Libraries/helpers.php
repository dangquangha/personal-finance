<?php

if (!function_exists('textareaBreakLine')) {
    /**
     * Display content textarea with break line
     * 
     * @var string|null
     */
    function textareaBreakLine($content) {
        return nl2br(e($content));
    }
}
<?php
use Illuminate\Support\Facades\Route;

Route::get('/debug-tinker', function () {
    try {
        $files = app('files');
        return get_class($files);
    } catch (\Exception $e) {
        return 'Erro: ' . $e->getMessage();
    }
});

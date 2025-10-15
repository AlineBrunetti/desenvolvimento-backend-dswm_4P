<?php

// routes/api.php
use App\Http\Controllers\ReportController;
// Exemplo de rota: GET /api/reports/pdf ou GET /api/reports/csv
Route::get('/reports/{type}', [ReportController::class, 'download']);
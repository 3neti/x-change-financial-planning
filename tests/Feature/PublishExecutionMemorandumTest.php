<?php

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;
use Spatie\Browsershot\Browsershot;

test('memorandum publish command is registered', function () {
    expect(app(Kernel::class)->all())->toHaveKey('memorandum:publish');
});

test('memorandum publish command creates publication outputs', function () {
    $files = app(Filesystem::class);
    $memorandumDirectory = storage_path('app/publications/execution-memorandum');
    $memorandumHtmlPath = $memorandumDirectory.'/execution-memorandum.html';
    $memorandumPdfPath = $memorandumDirectory.'/execution-memorandum.pdf';
    $briefDirectory = storage_path('app/publications/execution-brief');
    $briefHtmlPath = $briefDirectory.'/execution-brief.html';
    $briefPdfPath = $briefDirectory.'/execution-brief.pdf';

    $files->deleteDirectory($memorandumDirectory);
    $files->deleteDirectory($briefDirectory);

    $exitCode = Artisan::call('memorandum:publish');
    $output = Artisan::output();

    expect($exitCode)->toBe(0);

    if (! publicationPdfEngineAvailable()) {
        expect($output)->toContain('Recommended PDF engine: barryvdh/laravel-dompdf');
    }

    clearstatcache();

    expect(is_dir($memorandumDirectory))->toBeTrue();
    expect(is_file($memorandumHtmlPath))->toBeTrue();
    expect(is_dir($briefDirectory))->toBeTrue();
    expect(is_file($briefHtmlPath))->toBeTrue();

    $memorandumHtml = $files->get($memorandumHtmlPath);
    $briefHtml = $files->get($briefHtmlPath);

    expect($memorandumHtml)->toContain('Before We Begin');
    expect($memorandumHtml)->toContain('The Gap');
    expect($memorandumHtml)->toContain('The Rub');
    expect($memorandumHtml)->toContain('The Huddle');
    expect($memorandumHtml)->toContain('Payoff');
    expect($memorandumHtml)->toContain('This document exists because of trust.');
    expect($memorandumHtml)->toContain('It closes the gap.');
    expect($memorandumHtml)->toContain('One of the most valuable reminders you have given me is that technology is never the story.');
    expect($briefHtml)->toContain('An Invitation');
    expect($briefHtml)->toContain('Why This Work');
    expect($briefHtml)->toContain('Why Now');
    expect($briefHtml)->toContain('Where We Begin');
    expect($briefHtml)->toContain('The Future');
    expect($briefHtml)->toContain('Money should adapt to people.');
    expect($briefHtml)->toContain('This brief is simply an invitation.');

    if (publicationPdfEngineAvailable()) {
        expect(is_file($memorandumPdfPath))->toBeTrue();
        expect(is_file($briefPdfPath))->toBeTrue();
    } else {
        expect(is_file($memorandumPdfPath))->toBeFalse();
        expect(is_file($briefPdfPath))->toBeFalse();
    }
});

function publicationPdfEngineAvailable(): bool
{
    return class_exists(Browsershot::class)
        || class_exists(Pdf::class);
}

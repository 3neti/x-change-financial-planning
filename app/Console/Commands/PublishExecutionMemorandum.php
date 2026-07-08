<?php

namespace App\Console\Commands;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Console\Command;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Spatie\Browsershot\Browsershot;
use Throwable;

class PublishExecutionMemorandum extends Command
{
    protected $signature = 'memorandum:publish';

    protected $description = 'Publish the execution memorandum to HTML and PDF outputs.';

    public function __construct(
        private readonly Filesystem $files,
        private readonly ViewFactory $views,
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        foreach ($this->publicationDefinitions() as $publication) {
            $result = $this->publishDocument($publication);

            if ($result === self::FAILURE) {
                return self::FAILURE;
            }
        }

        return self::SUCCESS;
    }

    /**
     * @return array<int, array{
     *     source: string,
     *     output_directory: string,
     *     output_html: string,
     *     output_pdf: string,
     *     view: string,
     *     title: string,
     *     subject: string,
     *     preparedFor: string,
     *     preparedBy: string,
     *     publicationYear: string,
     * }>
     */
    private function publicationDefinitions(): array
    {
        return [
            [
                'source' => resource_path(
                    'knowledge/x-change-financial-planning/engagements/founding-execution-partner-2026/editorial/execution-memorandum.md',
                ),
                'output_directory' => 'publications/execution-memorandum',
                'output_html' => 'execution-memorandum.html',
                'output_pdf' => 'execution-memorandum.pdf',
                'view' => 'publications.execution-memorandum',
                'title' => 'Execution Memorandum',
                'subject' => 'x-change',
                'preparedFor' => 'Claire',
                'preparedBy' => 'Lester Hurtado',
                'publicationYear' => '2026',
            ],
            [
                'source' => resource_path(
                    'knowledge/x-change-financial-planning/engagements/founding-execution-partner-2026/editorial/execution-brief.md',
                ),
                'output_directory' => 'publications/execution-brief',
                'output_html' => 'execution-brief.html',
                'output_pdf' => 'execution-brief.pdf',
                'view' => 'publications.execution-memorandum',
                'title' => 'Execution Brief',
                'subject' => 'x-change',
                'preparedFor' => 'Claire',
                'preparedBy' => 'Lester Hurtado',
                'publicationYear' => '2026',
            ],
        ];
    }

    /**
     * @param array{
     *     source: string,
     *     output_directory: string,
     *     output_html: string,
     *     output_pdf: string,
     *     view: string,
     *     title: string,
     *     subject: string,
     *     preparedFor: string,
     *     preparedBy: string,
     *     publicationYear: string,
     * } $publication
     */
    private function publishDocument(array $publication): int
    {
        if (! $this->files->exists($publication['source'])) {
            $this->error("Canonical manuscript not found at [{$publication['source']}].");

            return self::FAILURE;
        }

        $outputDirectory = storage_path('app/'.$publication['output_directory']);
        $htmlPath = $outputDirectory.'/'.$publication['output_html'];
        $pdfPath = $outputDirectory.'/'.$publication['output_pdf'];

        $this->files->ensureDirectoryExists($outputDirectory);

        $markdown = $this->files->get($publication['source']);
        $manuscriptHtml = Str::markdown($markdown, [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        $styles = $this->files->get(resource_path('css/publications/execution-memorandum.css'));

        $html = $this->views->make($publication['view'], [
            'manuscriptHtml' => $manuscriptHtml,
            'styles' => $styles,
            'title' => $publication['title'],
            'subject' => $publication['subject'],
            'preparedFor' => $publication['preparedFor'],
            'preparedBy' => $publication['preparedBy'],
            'publicationYear' => $publication['publicationYear'],
        ])->render();

        $this->files->put($htmlPath, $html);

        $this->info("HTML publication saved: {$htmlPath}");

        $pdfEngine = $this->generatePdf($html, $pdfPath);

        if ($pdfEngine === null) {
            $this->warn('PDF not generated. No supported PDF engine is installed.');
            $this->warn('Recommended PDF engine: barryvdh/laravel-dompdf');
        } else {
            $this->info("PDF publication saved: {$pdfPath}");
            $this->line("PDF engine used: {$pdfEngine}");
        }

        return self::SUCCESS;
    }

    private function generatePdf(string $html, string $pdfPath): ?string
    {
        if ($engine = $this->generatePdfWithBrowsershot($html, $pdfPath)) {
            return $engine;
        }

        if ($engine = $this->generatePdfWithDompdf($html, $pdfPath)) {
            return $engine;
        }

        return null;
    }

    private function generatePdfWithBrowsershot(string $html, string $pdfPath): ?string
    {
        if (! class_exists(Browsershot::class)) {
            return null;
        }

        try {
            Browsershot::html($html)
                ->format('A4')
                ->margins(24, 22, 24, 22)
                ->showBackground()
                ->savePdf($pdfPath);

            return 'spatie/browsershot';
        } catch (Throwable $exception) {
            $this->warn("Browsershot PDF generation failed: {$exception->getMessage()}");

            return null;
        }
    }

    private function generatePdfWithDompdf(string $html, string $pdfPath): ?string
    {
        if (! class_exists(Pdf::class)) {
            return null;
        }

        try {
            Pdf::loadHTML($html)
                ->setPaper('a4')
                ->save($pdfPath);

            return 'barryvdh/laravel-dompdf';
        } catch (Throwable $exception) {
            $this->warn("Dompdf PDF generation failed: {$exception->getMessage()}");

            return null;
        }
    }
}

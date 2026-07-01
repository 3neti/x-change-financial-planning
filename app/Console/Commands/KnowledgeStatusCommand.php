<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class KnowledgeStatusCommand extends Command
{
    protected $signature = 'knowledge:status';

    protected $description = 'Report the status of knowledge repository domains.';

    public function __construct(private readonly Filesystem $files)
    {
        parent::__construct();
    }

    public function handle(): int
    {
        $knowledgeRoot = resource_path('knowledge');

        if (! $this->files->isDirectory($knowledgeRoot)) {
            $this->warn('No knowledge domains found.');

            return self::SUCCESS;
        }

        $rows = [];

        foreach ($this->files->directories($knowledgeRoot) as $domainPath) {
            $domain = basename($domainPath);

            $rows[] = [
                $domain,
                $this->indicator($this->files->exists($domainPath.'/metadata/project.yaml')),
                $this->indicator($this->files->exists($domainPath.'/source/overview.md')),
                $this->indicator($this->files->isDirectory($domainPath.'/working')),
                $this->indicator($this->files->isDirectory($domainPath.'/data')),
                $this->indicator($this->files->isDirectory($domainPath.'/assets')),
            ];
        }

        usort(
            $rows,
            static fn (array $left, array $right): int => $left[0] <=> $right[0],
        );

        $this->table(
            ['Domain', 'Metadata', 'Source', 'Working', 'Data', 'Assets'],
            $rows,
        );

        return self::SUCCESS;
    }

    private function indicator(bool $value): string
    {
        return $value ? 'yes' : 'no';
    }
}

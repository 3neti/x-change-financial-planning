<?php

test('knowledge governance and domain files exist', function () {
    expect(is_file(base_path('docs/governance/knowledge-canon-v1.md')))->toBeTrue();
    expect(is_file(base_path('docs/governance/working-artifact-specification-v1.md')))->toBeTrue();
    expect(is_file(base_path('resources/knowledge/x-change-financial-planning/metadata/project.yaml')))->toBeTrue();
    expect(is_file(base_path('resources/knowledge/x-change-financial-planning/source/overview.md')))->toBeTrue();
    expect(is_dir(base_path('resources/knowledge/x-change-financial-planning/working')))->toBeTrue();
});

test('knowledge status command runs successfully', function () {
    $this->artisan('knowledge:status')
        ->expectsTable(
            ['Domain', 'Metadata', 'Source', 'Working', 'Data', 'Assets'],
            [
                [
                    'x-change-financial-planning',
                    'yes',
                    'yes',
                    'yes',
                    'yes',
                    'yes',
                ],
            ],
        )
        ->assertSuccessful();
});

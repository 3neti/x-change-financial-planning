<?php

test('knowledge governance and domain files exist', function () {
    expect(is_file(base_path('docs/governance/knowledge-canon-v1.md')))->toBeTrue();
    expect(is_file(base_path('docs/governance/working-artifact-specification-v1.md')))->toBeTrue();
    expect(is_file(base_path('docs/governance/decisions/0007-use-evidence-backed-assumptions.md')))->toBeTrue();
    expect(is_file(base_path('docs/governance/decisions/0008-generated-artifacts-are-compiled-from-knowledge.md')))->toBeTrue();
    expect(is_file(base_path('docs/governance/decisions/0009-use-engagement-workspaces-for-stakeholder-specific-strategy.md')))->toBeTrue();
    expect(is_file(base_path('docs/governance/future-knowledge-commands.md')))->toBeTrue();
    expect(is_file(base_path('resources/knowledge/x-change-financial-planning/README.md')))->toBeTrue();
    expect(is_file(base_path('resources/knowledge/x-change-financial-planning/concepts/README.md')))->toBeTrue();
    expect(is_file(base_path('resources/knowledge/x-change-financial-planning/concepts/bridge-revenue.md')))->toBeTrue();
    expect(is_file(base_path('resources/knowledge/x-change-financial-planning/concepts/active-institutional-programs.md')))->toBeTrue();
    expect(is_file(base_path('resources/knowledge/x-change-financial-planning/metadata/project.yaml')))->toBeTrue();
    expect(is_file(base_path('resources/knowledge/x-change-financial-planning/source/overview.md')))->toBeTrue();
    expect(is_dir(base_path('resources/knowledge/x-change-financial-planning/working')))->toBeTrue();
    expect(is_file(base_path('resources/knowledge/x-change-financial-planning/working/00-vision.md')))->toBeTrue();
    expect(is_file(base_path('resources/knowledge/x-change-financial-planning/working/09-scenario-framework.md')))->toBeTrue();
    expect(is_file(base_path('resources/knowledge/x-change-financial-planning/working/10-assumptions-register.md')))->toBeTrue();
    expect(is_file(base_path('resources/knowledge/x-change-financial-planning/data/philippine-banking/README.md')))->toBeTrue();
    expect(is_file(base_path('resources/knowledge/x-change-financial-planning/data/pilot-estimates/README.md')))->toBeTrue();
    expect(is_file(base_path('build/README.md')))->toBeTrue();
    expect(is_file(base_path('build/investor-decks/README.md')))->toBeTrue();
    expect(is_file(base_path('build/financial-models/README.md')))->toBeTrue();
    expect(is_file(base_path('build/spreadsheets/README.md')))->toBeTrue();
    expect(is_file(base_path('build/reports/README.md')))->toBeTrue();
    expect(is_file(base_path('build/executive-summaries/README.md')))->toBeTrue();
    expect(is_file(base_path('build/presentations/README.md')))->toBeTrue();
    expect(is_file(base_path('resources/knowledge/x-change-financial-planning/engagements/README.md')))->toBeTrue();
    expect(is_file(base_path('resources/knowledge/x-change-financial-planning/engagements/founding-execution-partner-2026/README.md')))->toBeTrue();
    expect(is_file(base_path('resources/knowledge/x-change-financial-planning/engagements/founding-execution-partner-2026/working/00-engagement-overview.md')))->toBeTrue();
    expect(is_file(base_path('resources/knowledge/x-change-financial-planning/engagements/founding-execution-partner-2026/working/04-cash-continuity-use-case.md')))->toBeTrue();
    expect(is_file(base_path('resources/knowledge/x-change-financial-planning/engagements/founding-execution-partner-2026/working/06-open-questions.md')))->toBeTrue();
});

test('knowledge metadata contains the founding execution partner engagement', function () {
    $contents = file_get_contents(base_path('resources/knowledge/x-change-financial-planning/metadata/project.yaml'));

    expect($contents)->toContain('founding_execution_partner_2026');
    expect($contents)->toContain('resources/knowledge/x-change-financial-planning/engagements/founding-execution-partner-2026');
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

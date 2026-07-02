# 0008 — Generated Artifacts Are Compiled From Knowledge

## Status

Accepted

## Context

Investor decks, spreadsheets, reports, presentations, and executive summaries are generated representations of the underlying strategy.

Treating them as primary artifacts creates duplication and divergence.

## Decision

The repository shall treat generated artifacts as compiled outputs.

Canonical knowledge remains in:

- Governance
- Concepts
- Working Strategy
- Evidence

Generated artifacts are derived.

## Consequences

- Knowledge is edited once.
- Outputs remain reproducible.
- Multiple presentation formats can evolve independently.
- Strategy remains the single source of truth.

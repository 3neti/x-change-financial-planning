# 0002 — Separate Source, Working, and Generated Artifacts

## Status

Accepted

## Context

Financial planning work passes through several forms before it becomes a reusable investor output.

Confusing source materials, working interpretations, assumptions, structured data, and generated outputs makes revision difficult.

## Decision

Separate the following artifact classes:

- Source Materials
- Working Artifacts
- Structured Data Inputs
- Supporting Assets
- Generated Outputs

## Consequences

- Original source materials remain preserved.
- Working artifacts can evolve without overwriting the source.
- Derived outputs can be regenerated.
- Presentation changes do not require rewriting canonical source material.

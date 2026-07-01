# 0003 — Store Structured Data and Assets Alongside Prose

## Status

Accepted

## Context

The financial planning domain will require more than prose. It may include numeric assumptions, CSV files, figures, charts, diagrams, scenario tables, investor-ready summaries, and supporting assets.

If these materials are stored outside the repository structure, the knowledge system becomes fragmented.

## Decision

Store structured data and supporting assets alongside prose within the same repository model.

## Consequences

- Data-backed work remains reproducible.
- Charts and figures stay connected to their source context.
- Reviewers can inspect both narrative and evidence together.
- Future automation can target a stable file layout.

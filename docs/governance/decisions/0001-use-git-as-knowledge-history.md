# 0001 — Use Git as Knowledge History

## Status

Accepted

## Context

This repository needs a durable way to track revisions, authorship, analytical changes, modeling assumptions, and historical decisions.

Rather than inventing a separate history mechanism, the repository will use Git as the primary record of change.

## Decision

Use Git commits, branches, tags, and diffs as the canonical knowledge history.

## Consequences

- Changes are reviewable.
- Analytical and strategic decisions are traceable.
- Milestones can be tagged.
- Generated artifacts are not the source of truth.

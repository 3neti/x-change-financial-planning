# 0009 - Use Engagement Workspaces for Stakeholder-Specific Strategy

## Status

Accepted

## Context

The repository contains canonical strategy, concepts, assumptions, and evidence.

However, specific funding conversations, pilots, bank presentations, and investor engagements require stakeholder-specific assembly of the canonical knowledge.

Placing these documents directly under the canonical working strategy would confuse durable strategy with audience-specific presentation.

## Decision

Use engagement workspaces under `resources/knowledge/<domain>/engagements/` for stakeholder-specific strategy work.

## Consequences

- Canonical strategy remains reusable.
- Investor or partner-specific documents can evolve independently.
- Engagements can consume concepts, strategy, and evidence without owning them.
- Generated outputs still belong under `build/`.

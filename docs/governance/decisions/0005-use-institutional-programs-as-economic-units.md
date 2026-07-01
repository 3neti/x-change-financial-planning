# 0005 — Use Institutional Programs as Economic Units

## Status

Accepted

## Context

x-change should not be modeled primarily by geography, retail users, wallet users, or OFW population counts.

The platform grows through institutions that already possess users and operate programs.

A single institution may launch several programs over time.

Examples:

- Payroll
- Disaster relief
- Loan disbursement
- Treasury
- Remittance
- Corporate payouts
- Subsidies
- Benefits
- Settlement programs

## Decision

Use institutional programs as the primary economic unit for financial planning.

The planning hierarchy is:

```text
Institution
    ↓
Program
    ↓
Beneficiaries
    ↓
Settlement Instructions
    ↓
Platform Revenue
    ↓
Cash Flow
```

## Consequences

- Institution count alone is insufficient.
- Active Institutional Programs become a key planning metric.
- Expansion revenue can occur inside an existing institution.
- Geography becomes a deployment parameter, not the primary forecasting axis.

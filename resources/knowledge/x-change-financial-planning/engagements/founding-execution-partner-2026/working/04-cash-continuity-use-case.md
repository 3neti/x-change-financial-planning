# Cash Continuity Use Case

## Purpose

Define the first concrete commercial use case discovered for x-change / x-Payout.

## Observed Problem

In money changer branches, especially late in the day, signs may appear saying:

"No more PHP."

This means the branch may be unable to buy foreign currency because it lacks peso cash.

In malls, customers can easily walk to a competitor.

In some malls, there may be 2-3 nearby money changers.

In SM malls, there may be even more, including customer-service counters that also act as foreign exchange dealers.

## Business Problem

When a customer is ready to sell foreign currency and the branch has no pesos, the branch may lose the transaction.

The customer may go to the next competitor.

This transfers revenue directly to a competitor.

The problem is not merely operational inconvenience.

The problem is lost revenue and possibly lost customer loyalty.

## Proposed Capability

x-change / x-Payout could allow the money changer to complete the transaction even when the branch lacks physical pesos.

Instead of cash, the customer receives digital settlement.

Possible customer-facing options:

- GCash
- Maya
- Bank account
- Other supported settlement options

## Important Product Discovery

The customer should not initially be asked:

"Do you want a Pay Code?"

Customers do not yet know what Pay Code means.

Instead, the customer should be asked in familiar terms:

"Would you like us to send the proceeds to GCash or Maya instead?"

Pay Code can remain the internal settlement instruction.

Infrastructure should be invisible.

## Possible Customer Flow

```text
Customer wants to sell foreign currency
    ↓
Branch has insufficient PHP cash
    ↓
Cashier asks whether customer has a smartphone
    ↓
Customer scans QR code or opens a web page
    ↓
Customer chooses GCash, Maya, bank, or another option
    ↓
x-change issues/redeems settlement instruction behind the scenes
    ↓
Customer receives value digitally
    ↓
Money changer preserves transaction and earns the spread
```

## Potential Headline

"Never lose a foreign exchange transaction simply because the branch ran out of pesos."

Alternative capability names:

- Cash Continuity
- Revenue Protection
- Liquidity Continuity
- Branch Continuity
- Continuous Settlement
- No Lost Transactions

## Why This Matters

This use case is powerful because it does not require explaining fintech architecture.

The demonstration is obvious:

Normally, "No more PHP" means the sale is lost.

With x-change, the sale still happens.

## Depends on Concepts

- Bridge Revenue
- Proof of Execution
- Institutional Program
- Active Institutional Programs

## Supported by Evidence

- institution-profiles
- pilot-estimates
- implementation-costs

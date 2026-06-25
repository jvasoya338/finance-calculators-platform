<?php

namespace App\Support;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class CalculatorEditorial
{
    public static function forCalculator(array $calculator): array
    {
        $fieldLabels = collect($calculator['fields'] ?? [])
            ->map(fn (array $field) => $field['label'] ?? null)
            ->filter()
            ->values();

        return [
            'overview' => self::overview($calculator),
            'input_highlights' => self::inputHighlights($calculator, $fieldLabels),
            'interpretation' => self::interpretation($calculator),
            'tips' => self::tips($calculator),
            'related_guides' => self::relatedGuides($calculator),
        ];
    }

    public static function forCategory(array $category): array
    {
        $guides = collect(self::categoryGuideMap()[$category['slug']] ?? [])
            ->map(fn (string $slug) => config("guides.{$slug}"))
            ->filter()
            ->values();

        return [
            'planning_points' => self::categoryPlanningPoints($category),
            'guide_links' => $guides,
        ];
    }

    protected static function overview(array $calculator): array
    {
        $title = $calculator['title'];
        $categoryName = Str::lower($calculator['category_name']);

        return match ($calculator['type']) {
            'amortized_loan' => [
                "A good {$title} helps you test affordability before you borrow, not after paperwork has already started. Changing the loan size, interest rate, or repayment length shows how sensitive your monthly obligation is to each decision.",
                'That matters because installment borrowing is rarely only about qualifying for the loan. It is about keeping the payment sustainable inside the rest of your budget while understanding the total interest cost that builds over time.',
            ],
            'mortgage' => [
                'Mortgage planning works best when you compare both the monthly payment and the full borrowing cost. A small change in down payment, interest rate, or term can materially change the long-term cost of owning the property.',
                "This {$title} keeps the focus on principal-and-interest math so the result stays useful across countries, lenders, and different property markets. It gives you a clean base for affordability discussions before you layer in local fees or taxes.",
            ],
            'sip', 'investment', 'compound_interest', 'retirement', 'fixed_deposit', 'recurring_deposit' => [
                "Investment planning becomes clearer when you can separate what comes from your own contributions and what comes from growth. This {$title} is designed to help you see how time, return assumptions, and contribution size shape the result.",
                'That makes it easier to use the calculation as a planning tool instead of treating it as a prediction. Small differences in time horizon or return assumptions can create large changes in future value, especially across longer periods.',
            ],
            'income_tax', 'salary', 'take_home_salary', 'hourly_wage' => [
                "Income planning is stronger when the numbers connect back to real monthly life. This {$title} helps translate headline pay figures into more practical planning numbers for taxes, deductions, working hours, or take-home income.",
                'Because payroll and tax rules vary by country, the goal here is clarity first. The result gives you a usable baseline for budgeting, comparing offers, or estimating after-tax cash flow without pretending every jurisdiction works the same way.',
            ],
            'sales_tax' => [
                "Indirect tax calculations are easiest to trust when the logic is visible. This {$title} shows whether tax is being added to a base amount or extracted from a tax-inclusive total so you can review invoices, pricing, or receipts more confidently.",
                'It is also useful because GST, VAT, and sales tax language differs across regions even when the percentage math is similar. The page stays simple enough for worldwide use while still making the result easy to interpret.',
            ],
            'credit_card_interest', 'debt_payoff', 'loan_eligibility' => [
                "Debt and credit decisions are often more emotional than they first appear, so transparency matters. This {$title} helps turn a stressful question into numbers you can review calmly: monthly pressure, payoff timing, borrowing room, or interest drag.",
                'Once the result is visible, it becomes easier to compare scenarios and choose a path that is realistic instead of optimistic. That is especially important when higher interest rates or existing obligations make the margin for error smaller.',
            ],
            'budget', 'expense' => [
                "Budget tools are most helpful when they show where pressure is coming from, not just whether the final number is positive or negative. This {$title} is built to turn everyday money flow into a clearer monthly picture.",
                'That clarity helps with tradeoffs. Once you can see how income, fixed costs, and flexible expenses interact, it becomes much easier to protect savings, reduce leakage, or decide which category needs attention first.',
            ],
            'currency_converter' => [
                "Currency planning gets more useful when the exchange assumption is explicit. This {$title} lets you test a rate directly so you can estimate conversions for travel budgets, invoices, transfers, or international comparisons.",
                'Using a manual rate also makes the result easier to audit. You can compare the figure against your bank, card provider, or market quote and decide how much buffer to keep for fees or rate movement.',
            ],
            default => [
                "This {$title} is part of the FinguruTools {$categoryName} library and is designed to turn financial planning questions into clearer working numbers.",
                'The goal is not only to generate a result quickly, but to make the assumptions, tradeoffs, and next steps easier to understand.',
            ],
        };
    }

    protected static function inputHighlights(array $calculator, Collection $fieldLabels): array
    {
        return $fieldLabels
            ->take(3)
            ->map(function (string $label, int $index) {
                $clean = Str::lower($label);
                $context = match ($index) {
                    0 => "Start with {$clean}, because it shapes the entire result and usually has the biggest absolute impact on the final output.",
                    1 => "Review {$clean} carefully, since even a small change here can shift affordability, growth, or tax burden more than expected.",
                    default => "{$label} adds planning context to the result and helps you compare short-term comfort with long-term cost or value.",
                };

                return [
                    'title' => $label,
                    'body' => $context.' In practice, it works best to test multiple scenarios instead of relying on a single estimate.',
                ];
            })
            ->values()
            ->all();
    }

    protected static function interpretation(array $calculator): array
    {
        return match ($calculator['type']) {
            'amortized_loan', 'mortgage' => [
                'If the payment fits your monthly cash flow but the total interest feels too high, the next comparison is usually a shorter term, a larger down payment, or a lower loan amount.',
                'If the monthly payment already feels tight, that is often a signal to test affordability before moving ahead, because even modest rate changes can push the budget further than expected.',
            ],
            'sip', 'investment', 'compound_interest', 'retirement', 'fixed_deposit', 'recurring_deposit' => [
                'A future-value estimate is usually best read as a planning range, not a promise. The main question is whether the current contribution level and time horizon move you meaningfully toward the target you care about.',
                'If the projection feels too low, the highest-leverage changes are often starting earlier, contributing more consistently, or extending the time horizon rather than chasing unrealistic return assumptions.',
            ],
            'income_tax', 'salary', 'take_home_salary', 'hourly_wage' => [
                'The strongest use of the result is practical planning: compare roles, budget from net income, and judge fixed commitments against what is actually available after taxes and deductions.',
                'If the output feels surprisingly tight, that is useful information. It often means a gross income number is creating more comfort than the real monthly cash flow actually supports.',
            ],
            'sales_tax' => [
                'This result is easiest to use when you keep the transaction context in mind. Inclusive calculations help unpack receipts and gross totals, while exclusive calculations help with quotes and base pricing.',
                'If the numbers look off, the first thing to recheck is whether the entered amount is pre-tax or post-tax. That single assumption changes the entire output.',
            ],
            'credit_card_interest', 'debt_payoff', 'loan_eligibility' => [
                'The output becomes most useful when you test multiple realistic scenarios rather than only the current one. Slightly higher payments, lower existing obligations, or a different term can meaningfully change the path.',
                'If the result looks uncomfortable, that is not a failure. It is an early planning signal that can help you avoid a decision that would become much harder later.',
            ],
            'budget', 'expense' => [
                'The number matters less than the pattern behind it. A small monthly surplus or recurring overspend can reveal where cash flow needs more structure before bigger goals become realistic.',
                'If the result is negative, the next step is usually to identify which spending is fixed, which is adjustable, and which savings goals need to be phased instead of abandoned.',
            ],
            'currency_converter' => [
                'A conversion result is best treated as a working estimate. Banks, cards, remittance providers, and marketplaces often apply their own spread or extra fee on top of the quoted rate.',
                'That means the safest planning move is to keep a small buffer whenever the converted value is tied to travel, transfers, or international purchase decisions.',
            ],
            default => [
                'Use the result as a planning checkpoint rather than a final answer. The biggest value usually comes from comparing a few realistic scenarios side by side.',
                'That comparison process makes the tool more useful than a one-time number, because it helps you see which inputs are actually driving the outcome.',
            ],
        };
    }

    protected static function tips(array $calculator): array
    {
        return match ($calculator['type']) {
            'amortized_loan', 'mortgage' => [
                'Test one shorter and one longer term so you can weigh payment comfort against lifetime interest.',
                'Re-run the estimate after changing the rate by a small margin to see how sensitive the loan is to lender terms.',
                'Compare the result against your broader monthly budget, not just the loan itself.',
            ],
            'sip', 'investment', 'compound_interest', 'retirement', 'fixed_deposit', 'recurring_deposit' => [
                'Use a conservative return assumption first, then compare it with a more optimistic scenario.',
                'Check whether increasing contributions or extending the time horizon has the larger impact for your goal.',
                'Keep the estimate connected to a real target such as retirement, education, or emergency reserves.',
            ],
            'income_tax', 'salary', 'take_home_salary', 'hourly_wage' => [
                'Compare the result with your expected monthly fixed costs before making bigger commitments.',
                'Use the same assumptions when comparing multiple jobs or income scenarios.',
                'Where local rules differ, treat the number as a planning estimate and verify final payroll details separately.',
            ],
            'sales_tax' => [
                'Double-check whether your entered amount is pre-tax or tax-inclusive before relying on the result.',
                'Use the same tax mode consistently when comparing invoices or pricing options.',
                'If you operate across regions, keep rate assumptions labeled clearly to avoid mixing tax systems.',
            ],
            'credit_card_interest', 'debt_payoff', 'loan_eligibility' => [
                'Run a higher-payment scenario to see how much time or interest you can save with modest extra effort.',
                'Use the result together with a monthly budget so the plan stays realistic.',
                'Treat lender or issuer decisions separately from the estimate, since real underwriting rules can vary.',
            ],
            'budget', 'expense' => [
                'Review the largest category first, because that is usually where meaningful change is easiest to find.',
                'Use net income instead of gross income when you want a more realistic monthly picture.',
                'Repeat the calculation after small spending changes to see which adjustments meaningfully improve the margin.',
            ],
            'currency_converter' => [
                'Keep a small buffer for provider fees or spreads if the conversion affects a real payment.',
                'Compare at least two exchange assumptions when the rate is moving quickly.',
                'Use the calculator as a planning aid, then confirm the executable rate with your provider.',
            ],
            default => [
                'Test more than one scenario so the result becomes a decision tool rather than a single snapshot.',
                'Keep the assumptions consistent when comparing options.',
                'Use related guides and calculators to add context before acting on the number.',
            ],
        };
    }

    protected static function relatedGuides(array $calculator): Collection
    {
        $slugs = self::categoryGuideMap()[$calculator['category']] ?? [];

        return collect($slugs)
            ->map(fn (string $slug) => config("guides.{$slug}"))
            ->filter()
            ->take(2)
            ->values();
    }

    protected static function categoryPlanningPoints(array $category): array
    {
        return match ($category['slug']) {
            'loan-calculators' => [
                'Compare monthly affordability, total interest, and financed amount before choosing a borrowing structure.',
                'Use the library to model mortgages, home loans, car loans, student loans, and general installment borrowing in one place.',
                'Run multiple term and rate scenarios so borrowing decisions are based on long-term cost as well as monthly comfort.',
            ],
            'investment-calculators' => [
                'Project both contribution-driven growth and return-driven growth so long-term investing targets become easier to plan.',
                'Use different tools for lump sums, recurring contributions, retirement planning, and deposit-style products.',
                'Keep assumptions realistic and compare how time horizon changes the outcome before relying on expected returns alone.',
            ],
            'tax-calculators', 'salary-calculators' => [
                'Translate headline income into tax, take-home pay, and practical monthly planning numbers.',
                'Use these tools to compare salary structures, tax assumptions, and payroll outcomes across different scenarios.',
                'Where country rules vary, treat the output as a planning estimate and verify final local compliance separately.',
            ],
            'credit-calculators' => [
                'Estimate payoff time, interest drag, and borrowing capacity before a balance becomes harder to manage.',
                'Compare multiple payment scenarios to see where modest changes can meaningfully improve the timeline.',
                'Use the category together with the budgeting tools so debt plans remain realistic month after month.',
            ],
            'crypto-calculators' => [
                'Use recurring-buy and profit-tracking tools to keep crypto decisions grounded in position size, fees, and realistic assumptions.',
                'Compare how monthly buying plans build exposure over time instead of relying on a single entry point.',
                'Review crypto outcomes alongside budgeting and investing tools so volatility does not overwhelm the rest of your financial plan.',
            ],
            'budget-calculators' => [
                'Build a clearer monthly money picture by comparing income, expenses, and the room left for savings goals.',
                'Use category-level calculations to identify which areas create the most pressure on cash flow.',
                'Pair these tools with salary and debt pages when you want a broader planning workflow instead of isolated numbers.',
            ],
            default => [
                'Use the category as a planning hub, not only as a list of tools.',
                'Compare related calculators side by side to understand the tradeoffs behind each result.',
                'Move between calculators and guides so the numbers stay connected to real financial decisions.',
            ],
        };
    }

    protected static function categoryGuideMap(): array
    {
        return [
            'loan-calculators' => ['emi-affordability-before-borrowing', 'personal-loan-prepayment-planning', 'mortgage-offers', 'choosing-loan-term', 'down-payment-vs-cash-reserves'],
            'investment-calculators' => ['sip-investment-mistakes', 'retirement-contribution-planning', 'fixed-deposit-vs-recurring-deposit', 'compounding-time-horizons', 'emergency-fund-planning'],
            'tax-calculators' => ['gst-vs-vat-basic-difference', 'understanding-vat-inclusive-pricing', 'take-home-pay-planning'],
            'salary-calculators' => ['salary-budget-after-raise', 'take-home-pay-planning', 'salary-offer-net-pay'],
            'credit-calculators' => ['credit-card-interest-reduction', 'personal-loan-prepayment-planning', 'debt-payoff-strategy'],
            'crypto-calculators' => ['bitcoin-dca-discipline', 'crypto-position-sizing'],
            'budget-calculators' => ['monthly-expense-review-system', 'monthly-budget-framework', 'salary-budget-after-raise', 'emergency-fund-planning'],
        ];
    }
}

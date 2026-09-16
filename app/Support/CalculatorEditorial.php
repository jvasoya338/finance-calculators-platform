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
            'specs' => self::specs($calculator),
            'overview' => self::overview($calculator),
            'input_highlights' => self::inputHighlights($calculator, $fieldLabels),
            'interpretation' => self::interpretation($calculator),
            'tips' => self::tips($calculator),
            'considerations' => self::considerations($calculator),
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
            'framework_paragraphs' => self::categoryFramework($category),
            'guide_links' => $guides,
        ];
    }

    public static function seoProfileForCalculator(array $calculator): array
    {
        $title = $calculator['title'];

        return match ($calculator['type']) {
            'mortgage' => [
                'title' => "{$title} — Monthly Payment, Principal & Interest Estimator | FinguruTools",
                'description' => "Calculate your monthly mortgage payments, total interest, and full repayment schedule. Compare loan terms and down payment scenarios.",
                'keywords' => ['mortgage calculator', 'monthly mortgage payment', 'home loan interest', 'amortization schedule'],
            ],
            'amortized_loan' => [
                'title' => "{$title} — Monthly Installment & Interest Calculator | FinguruTools",
                'description' => "Estimate fixed monthly loan payments, lifetime interest cost, and amortization schedules for personal, auto, and commercial borrowing.",
                'keywords' => ['loan calculator', 'emi calculator', 'monthly payment calculator', 'loan repayment schedule'],
            ],
            'income_tax' => [
                'title' => "{$title} — Annual Tax & Take-Home Pay Estimator | FinguruTools",
                'description' => "Estimate taxable income, income tax brackets, effective tax rate, and net take-home earnings with multi-country baseline models.",
                'keywords' => ['income tax calculator', 'tax bracket estimator', 'net income calculator', 'after tax earnings'],
            ],
            'salary', 'take_home_salary', 'hourly_wage' => [
                'title' => "{$title} — Gross to Net Pay & Wage Conversion | FinguruTools",
                'description' => "Convert annual salary, hourly rates, and monthly pay into realistic take-home numbers after estimated taxes and deductions.",
                'keywords' => ['salary calculator', 'take home pay calculator', 'wage converter', 'gross to net salary'],
            ],
            'sales_tax' => [
                'title' => "{$title} — Net, Gross & Tax-Inclusive Price Breakdown | FinguruTools",
                'description' => "Calculate sales tax, VAT, or GST from base prices or extract the tax portion from tax-inclusive transaction totals.",
                'keywords' => ['sales tax calculator', 'vat calculator', 'gst calculator', 'tax inclusive calculator'],
            ],
            'credit_card_interest', 'debt_payoff', 'loan_eligibility' => [
                'title' => "{$title} — Payoff Timeline & Capacity Planner | FinguruTools",
                'description' => "Model debt reduction timelines, total interest savings, monthly repayment targets, and borrowing capacity limits.",
                'keywords' => ['credit card payoff calculator', 'debt payoff calculator', 'loan eligibility calculator', 'debt reduction planner'],
            ],
            'sip', 'investment', 'compound_interest', 'retirement', 'fixed_deposit', 'recurring_deposit' => [
                'title' => "{$title} — Growth Projection & Future Value Tool | FinguruTools",
                'description' => "Project investment growth, compound interest accumulation, SIP returns, and retirement nest egg targets over time.",
                'keywords' => ['investment calculator', 'compound interest calculator', 'sip calculator', 'retirement savings planner'],
            ],
            'crypto_dca', 'crypto_profit' => [
                'title' => "{$title} — Recurring Buy & Return Simulator | FinguruTools",
                'description' => "Simulate dollar-cost averaging and calculate realized profit, loss, and ROI for cryptocurrency positions.",
                'keywords' => ['crypto dca calculator', 'crypto profit calculator', 'bitcoin dca planner', 'crypto roi calculator'],
            ],
            'budget', 'expense' => [
                'title' => "{$title} — Monthly Cash Flow & Expense Planner | FinguruTools",
                'description' => "Plan household cash flow, categorize fixed and variable spending, and calculate your target monthly savings rate.",
                'keywords' => ['budget calculator', 'monthly expense planner', 'savings rate calculator', 'cash flow planner'],
            ],
            'currency_converter' => [
                'title' => "{$title} — Exchange Rate & Conversion Tool | FinguruTools",
                'description' => "Convert currency values using custom exchange rates for travel planning, international payments, and invoice reviews.",
                'keywords' => ['currency converter', 'exchange rate calculator', 'money conversion tool'],
            ],
            default => [
                'title' => "{$title} | FinguruTools",
                'description' => $calculator['meta_description'] ?? $calculator['short_description'],
                'keywords' => [$title, 'financial calculator'],
            ],
        };
    }

    public static function seoProfileForCategory(array $category): array
    {
        return match ($category['slug']) {
            'loan-calculators' => [
                'title' => 'Loan & Mortgage Calculators | FinguruTools',
                'description' => 'Explore loan and mortgage calculators to estimate monthly payments, compare terms, and analyze full repayment schedules.',
                'keywords' => ['loan calculators', 'mortgage calculators', 'emi tools', 'borrowing cost planners'],
            ],
            'investment-calculators' => [
                'title' => 'Investment & Compound Interest Calculators | FinguruTools',
                'description' => 'Model wealth accumulation, compounding growth, recurring SIP investments, and retirement nest eggs with practical tools.',
                'keywords' => ['investment calculators', 'compound interest', 'sip tools', 'retirement planning'],
            ],
            'tax-calculators' => [
                'title' => 'Tax, VAT & GST Calculators | FinguruTools',
                'description' => 'Estimate income taxes, effective rates, VAT-inclusive pricing, and sales tax breakdowns with clear math.',
                'keywords' => ['tax calculators', 'vat calculator', 'gst tools', 'income tax estimators'],
            ],
            'salary-calculators' => [
                'title' => 'Salary & Take-Home Pay Calculators | FinguruTools',
                'description' => 'Convert hourly wages, annual salaries, and deductions into clear net take-home pay estimates.',
                'keywords' => ['salary calculators', 'take home pay', 'hourly wage converter', 'payroll planning'],
            ],
            'credit-calculators' => [
                'title' => 'Credit Card & Debt Payoff Calculators | FinguruTools',
                'description' => 'Calculate debt payoff timelines, interest savings, and borrowing capacity limits with transparent tools.',
                'keywords' => ['debt payoff calculators', 'credit card interest', 'loan eligibility', 'debt reduction'],
            ],
            'crypto-calculators' => [
                'title' => 'Cryptocurrency DCA & Profit Calculators | FinguruTools',
                'description' => 'Analyze dollar-cost averaging strategies and calculate potential returns on digital asset allocations.',
                'keywords' => ['crypto calculators', 'bitcoin dca tool', 'crypto profit estimator'],
            ],
            'budget-calculators' => [
                'title' => 'Budgeting & Expense Planning Calculators | FinguruTools',
                'description' => 'Structure monthly income, manage living expenses, and track savings progress with practical budget tools.',
                'keywords' => ['budget calculators', 'expense trackers', 'cash flow tools', 'savings planners'],
            ],
            default => [
                'title' => $category['name'].' | FinguruTools',
                'description' => $category['description'],
                'keywords' => [$category['name'], 'finance calculators'],
            ],
        };
    }

    protected static function specs(array $calculator): array
    {
        return match ($calculator['type']) {
            'mortgage' => [
                'model' => 'Standard Amortization',
                'output' => 'Principal & Interest',
                'scope' => 'Multi-Currency Global',
            ],
            'amortized_loan' => [
                'model' => 'Fixed-Rate Amortization',
                'output' => 'Equal Monthly Installment',
                'scope' => 'Multi-Currency Global',
            ],
            'sip', 'recurring_deposit' => [
                'model' => 'Annuity Series Compounding',
                'output' => 'Maturity & Growth Value',
                'scope' => 'Monthly Recurring Basis',
            ],
            'compound_interest', 'investment', 'fixed_deposit' => [
                'model' => 'Exponential Growth Formula',
                'output' => 'Principal + Accrued Interest',
                'scope' => 'Periodic Compounding',
            ],
            'retirement' => [
                'model' => 'Inflation-Adjusted Projection',
                'output' => 'Target Nest Egg & Savings',
                'scope' => 'Multi-Decade Horizon',
            ],
            'income_tax', 'salary', 'take_home_salary', 'hourly_wage' => [
                'model' => 'Progressive Bracket Simulation',
                'output' => 'Gross to Net Breakdown',
                'scope' => 'Annual & Monthly Basis',
            ],
            'sales_tax' => [
                'model' => 'Percentage Price Extraction',
                'output' => 'Tax Amount & Final Price',
                'scope' => 'Inclusive / Exclusive Mode',
            ],
            'credit_card_interest', 'debt_payoff' => [
                'model' => 'Iterative Balance Reduction',
                'output' => 'Payoff Timeline & Interest',
                'scope' => 'Fixed Monthly Payment',
            ],
            'loan_eligibility' => [
                'model' => 'Debt-to-Income Ratio Engine',
                'output' => 'Max Eligible Loan & EMI',
                'scope' => 'Income & Obligation Bounds',
            ],
            'crypto_dca', 'crypto_profit' => [
                'model' => 'Cost Basis & ROI Analysis',
                'output' => 'Accumulated Value & Return',
                'scope' => 'Periodic & Trade-Level',
            ],
            'budget', 'expense' => [
                'model' => 'Categorical Cash Flow Split',
                'output' => 'Surplus, Deficit & Rate',
                'scope' => 'Monthly Household Flow',
            ],
            default => [
                'model' => 'Standard Financial Math',
                'output' => 'Instant Numerical Result',
                'scope' => 'Universal Planning Model',
            ],
        };
    }

    protected static function overview(array $calculator): array
    {
        $title = $calculator['title'];

        return match ($calculator['type']) {
            'mortgage' => [
                "A mortgage represents one of the largest long-term financial obligations most individuals ever undertake. This {$title} calculates your exact monthly principal and interest obligations based on your home purchase price, down payment amount, nominal interest rate, and repayment duration.",
                'Beyond displaying the required monthly installment, this tool illustrates the total cost of financing over the life of the loan. Evaluating how varying down payments or loan terms alter lifetime interest enables you to establish an optimal balance between monthly cash-flow comfort and total borrowing expense.',
            ],
            'amortized_loan' => [
                "Installment borrowing requires a clear understanding of both short-term cash flow impact and long-term interest accrual. This {$title} calculates the fixed Equated Monthly Installment (EMI) necessary to completely amortize a loan over a designated repayment period.",
                'By breaking down each payment into its constituent principal and interest components across the full amortization schedule, this tool highlights how front-loaded interest charges operate and allows you to test rate and tenure sensitivities prior to formal application.',
            ],
            'sip', 'recurring_deposit' => [
                "Systematic, recurring investing leverages dollar-cost averaging and compound growth to build wealth progressively. This {$title} projects the estimated maturity value of consistent monthly contributions over your chosen investment horizon.",
                'The calculation distinctly separates your aggregate invested capital from accrued returns, providing a realistic view of how investment duration accelerates compounding in the later years of an investment program.',
            ],
            'compound_interest', 'investment', 'fixed_deposit' => [
                "Compounding is the mathematical foundation of long-term capital growth. This {$title} estimates the future value of an initial principal sum subject to a specified rate of return and compounding frequency over time.",
                'By demonstrating how reinvested earnings generate incremental returns of their own, this tool helps you quantify the financial impact of time horizon, rate differentials, and compounding frequency on your total accumulated capital.',
            ],
            'retirement' => [
                "Retirement planning requires balancing long-term wealth accumulation with future living expense requirements. This {$title} projects your expected retirement corpus based on current age, target retirement age, expected returns, and periodic contributions.",
                'By modeling multi-decade horizons, this calculator helps identify potential savings shortfalls early, allowing you to calibrate monthly savings targets and asset allocation strategies well in advance of retirement.',
            ],
            'income_tax', 'salary', 'take_home_salary', 'hourly_wage' => [
                "Understanding the relationship between gross earnings and actual net cash flow is essential for household budgeting and career decisions. This {$title} translates headline compensation figures into realistic take-home pay estimates by accounting for progressive tax rates and standard deductions.",
                'Because taxation frameworks differ across jurisdictions, this tool provides a standardized baseline model to evaluate job offers, pay increases, and hourly wage conversions with greater clarity.',
            ],
            'sales_tax' => [
                "Indirect taxes such as VAT, GST, and standard sales tax can be applied either on top of a net price or extracted from a gross receipt. This {$title} transparently calculates the exact tax liability and corresponding pre-tax or post-tax totals.",
                'Whether you are verifying supplier invoices, preparing client quotes, or auditing retail purchases, this tool ensures precision across both tax-inclusive and tax-exclusive pricing structures.',
            ],
            'credit_card_interest', 'debt_payoff' => [
                "Revolving debt at elevated interest rates can severely impair personal cash flow if repayment is not systematically managed. This {$title} calculates the exact number of months and total interest expense required to extinguish a balance under a given monthly payment amount.",
                'By illustrating the dramatic difference between paying only the required minimum versus committing a fixed extra monthly amount, this tool helps you design an accelerated, cost-effective debt payoff plan.',
            ],
            'loan_eligibility' => [
                "Lending institutions evaluate credit applications primarily through Debt-to-Income (DTI) and Fixed Obligation to Income (FOIR) ratios. This {$title} estimates your theoretical borrowing capacity based on your verifiable monthly income and existing financial liabilities.",
                'Understanding these constraints before approaching lenders helps prevent over-leveraging and clarifies what loan sizes fit safely within responsible underwriting thresholds.',
            ],
            'crypto_dca', 'crypto_profit' => [
                "Cryptocurrency markets exhibit significant price volatility, making systematic entry strategies and accurate cost-basis tracking essential. This {$title} models the performance of periodic recurring purchases (dollar-cost averaging) and calculates realized profit, loss, and percentage ROI.",
                'By removing emotional timing decisions from market participation, this tool helps investors evaluate asset allocations with objective historical mathematics and disciplined position sizing.',
            ],
            'budget', 'expense' => [
                "A sustainable financial plan begins with a clear, objective analysis of household cash flow. This {$title} structures your gross and net income alongside essential fixed obligations, variable living costs, and debt service.",
                'By quantifying your actual monthly surplus or deficit and resulting savings rate, this tool provides actionable visibility into where spending adjustments can produce the highest financial leverage.',
            ],
            'currency_converter' => [
                "Cross-border commerce, travel budgeting, and international remittances require transparent conversion mathematics. This {$title} allows you to convert currency amounts using custom or benchmark exchange rates.",
                'By allowing you to test specific exchange rate scenarios alongside transaction spread buffers, this tool helps you evaluate real foreign exchange costs before executing transfers.',
            ],
            default => [
                "This {$title} is designed to provide clear, reliable financial mathematics to assist in personal money management and scenario planning.",
                'The tool focuses on transparent formulas, actionable outputs, and practical planning insights to support informed financial decision-making.',
            ],
        };
    }

    protected static function inputHighlights(array $calculator, Collection $fieldLabels): array
    {
        return $fieldLabels
            ->take(3)
            ->map(function (string $label, int $index) use ($calculator) {
                $explanation = match ($calculator['type']) {
                    'mortgage', 'amortized_loan' => match ($index) {
                        0 => "The initial principal amount directly determines the scale of your monthly obligation. Reducing the borrowing amount through larger down payments directly compresses both monthly payments and lifetime interest.",
                        1 => "The interest rate dictates the cost of carrying the debt. Even a fractional variance in annual rate compounds significantly over multi-year tenures, altering total repayment amounts.",
                        default => "The repayment tenure balances monthly cash-flow affordability against aggregate borrowing cost. Longer terms reduce monthly payments but increase total interest paid.",
                    },
                    'sip', 'compound_interest', 'investment', 'retirement' => match ($index) {
                        0 => "Your contribution amount forms the principal base upon which all subsequent compounding occurs. Consistency in contributions is the primary driver of early-stage portfolio accumulation.",
                        1 => "The anticipated annual rate of return reflects your investment asset allocation. Using realistic, inflation-adjusted assumptions provides a more dependable planning foundation.",
                        default => "The investment duration provides the runway necessary for exponential compounding to manifest. Time invested is frequently more impactful than marginal differences in return rates.",
                    },
                    'income_tax', 'salary', 'take_home_salary', 'hourly_wage' => match ($index) {
                        0 => "Gross earnings serve as the starting baseline before statutory deductions, progressive income tax brackets, and mandatory contributions are applied.",
                        1 => "Tax filing status, applicable tax brackets, or country-specific allowances determine the progressive rate at which incremental income is taxed.",
                        default => "Working hours, bonus structures, or standard deductions refine the calculation from theoretical gross figures to actual spendable monthly cash flow.",
                    },
                    default => match ($index) {
                        0 => "The primary value establishes the baseline magnitude for the entire calculation model.",
                        1 => "The rate or percentage factor determines how the baseline value expands, discounts, or incurs expense over the modeled period.",
                        default => "The timeframe or secondary parameter provides essential context, defining the duration or conditions under which the math operates.",
                    },
                };

                return [
                    'title' => $label,
                    'body' => $explanation,
                ];
            })
            ->values()
            ->all();
    }

    protected static function interpretation(array $calculator): array
    {
        return match ($calculator['type']) {
            'mortgage', 'amortized_loan' => [
                'Examine the ratio of total interest to original principal. In long-term loans, interest can equal or exceed the amount initially borrowed. If lifetime interest appears excessive, consider shortening the loan duration or making periodic principal prepayments.',
                'Ensure the projected monthly installment remains well within your sustainable monthly budget (ideally under 28–36% of gross income including all other debt service) rather than maxing out lender pre-approval limits.',
            ],
            'sip', 'compound_interest', 'investment', 'fixed_deposit', 'recurring_deposit' => [
                'Compare the total accumulated wealth against your cumulative out-of-pocket contributions. Notice how the return component expands exponentially as the investment horizon lengthens past the 5- and 10-year marks.',
                'Treat future value projections as probabilistic planning benchmarks rather than guaranteed returns. Market returns fluctuate; testing conservative return assumptions ensures your plan remains robust.',
            ],
            'retirement' => [
                'Evaluate whether your projected corpus will sustain your desired post-retirement withdrawal rate (such as the standard 3.5–4% safe withdrawal rule). If a deficit appears, prioritize increasing monthly contributions or extending your accumulation timeline.',
                'Factor in inflation when reviewing future values: an nominal sum decades in the future will have significantly lower purchasing power in real terms.',
            ],
            'income_tax', 'salary', 'take_home_salary', 'hourly_wage' => [
                'Differentiate clearly between your marginal tax rate (the rate on your last earned unit of currency) and your effective tax rate (actual total tax divided by total gross income).',
                'Always construct household budgets around realistic net take-home earnings rather than headline gross salary figures.',
            ],
            'sales_tax' => [
                'Ensure you have selected the correct mode (tax-inclusive vs. tax-exclusive). Applying a tax rate directly to a gross total overstates the tax liability, as the tax must be extracted proportionally from the base.',
                'Use the itemized breakdown to audit vendor quotes, confirm supplier pricing accuracy, or verify invoice compliance.',
            ],
            'credit_card_interest', 'debt_payoff' => [
                'Note the aggregate interest penalty incurred by prolonging debt repayment. Increasing your monthly payment even marginally above the required minimum produces substantial reductions in both time-to-debt-free and total interest.',
                'Prioritize highest-interest balances first (the avalanche method) to minimize cumulative finance charges across multiple credit lines.',
            ],
            'loan_eligibility' => [
                'A high theoretical loan eligibility does not imply you should borrow the maximum amount. Lenders establish caps based on risk limits, but personal financial security requires keeping an ample monthly liquidity buffer.',
                'If your eligibility falls below your property or purchase target, focus on eliminating existing debts or extending loan tenure to lower the calculated monthly debt service ratio.',
            ],
            'crypto_dca', 'crypto_profit' => [
                'Review how periodic purchasing mitigates the risk of buying at localized market peaks by averaging your cumulative entry cost over time.',
                'Ensure that high-volatility digital asset allocations represent a prudent, risk-calibrated fraction of your overall diversified investment portfolio.',
            ],
            'budget', 'expense' => [
                'Review your discretionary expenses relative to non-negotiable living costs. A resilient budget typically allocates at least 15–20% of net income toward emergency reserves, debt reduction, and long-term investments.',
                'If monthly cash flow reflects a deficit, focus on addressing the largest recurring expenditure categories (housing, transportation, food) rather than minor incidental costs.',
            ],
            default => [
                'Use the calculation output as an objective decision-making checkpoint. Test multiple input scenarios to observe which variables exert the strongest influence on the final result.',
                'Complement numerical outputs with comprehensive financial planning principles before executing binding commitments.',
            ],
        };
    }

    protected static function tips(array $calculator): array
    {
        return match ($calculator['type']) {
            'mortgage', 'amortized_loan' => [
                'Model scenarios with a 0.5%–1.0% interest rate buffer to ensure monthly payments remain manageable if borrowing under adjustable rates.',
                'Evaluate the impact of making one extra monthly payment per year, which can shave years off a multi-decade loan term.',
                'Confirm all associated origination fees, closing costs, and insurance requirements before finalizing loan agreements.',
            ],
            'sip', 'compound_interest', 'investment', 'fixed_deposit', 'recurring_deposit' => [
                'Automate monthly contributions on the day following income receipt to maintain consistent investment discipline.',
                'Periodically increase your contribution amount in tandem with salary raises or bonus payouts to accelerate compounding.',
                'Avoid interrupting compounding through premature withdrawals unless navigating genuine financial emergencies.',
            ],
            'retirement' => [
                'Revisit retirement calculations annually to adjust for career salary progressions, actual investment performance, and life changes.',
                'Maintain a dedicated emergency liquidity fund separate from retirement accounts to prevent liquidation during market downturns.',
                'Consider tax-advantaged retirement accounts (such as 401(k), IRA, PPF, or ISA) to optimize after-tax accumulation.',
            ],
            'income_tax', 'salary', 'take_home_salary', 'hourly_wage' => [
                'Explore all permissible pre-tax deductions, retirement contributions, and healthcare savings accounts to legally optimize taxable income.',
                'When comparing employment offers across different regions, factor in local cost-of-living differences alongside nominal wage differences.',
                'Review withholding allowances periodically to avoid unexpected tax liabilities or excessive tax refund loans at year-end.',
            ],
            'sales_tax' => [
                'Verify whether local jurisdiction tax exemptions or reduced rates apply to specific commodity or service categories.',
                'Maintain explicit records of pre-tax amounts, tax rates, and tax collected for seamless accounting reconciliation.',
            ],
            'credit_card_interest', 'debt_payoff' => [
                'Commit to a fixed monthly repayment amount rather than decreasing your payment as your balance shrinks.',
                'Contact card issuers to negotiate lower APRs or explore balance transfer options with 0% promotional intro periods.',
                'Halt new discretionary charges on cards currently carrying balances subject to active finance charges.',
            ],
            'loan_eligibility' => [
                'Check your credit report well before applying for loans and resolve any inaccuracies to secure the most competitive interest tiers.',
                'Avoid opening new credit accounts or making large credit-financed purchases immediately prior to major loan applications.',
            ],
            'crypto_dca', 'crypto_profit' => [
                'Maintain a strict long-term schedule rather than attempting to pause or double DCA amounts based on short-term market sentiment.',
                'Keep thorough transaction records including date, fiat value, and network fees for accurate tax reporting.',
            ],
            'budget', 'expense' => [
                'Audit recurring subscriptions and automated monthly charges quarterly to eliminate unused services.',
                'Build a dedicated sinking fund for irregular annual expenses (vehicle maintenance, insurance premiums, property taxes).',
            ],
            default => [
                'Test both conservative and optimistic scenarios to understand the full sensitivity range of your financial plan.',
                'Verify critical calculations against official institutional documentation and qualified professional counsel.',
            ],
        };
    }

    protected static function considerations(array $calculator): array
    {
        $title = $calculator['title'];

        return match ($calculator['type']) {
            'mortgage', 'amortized_loan' => [
                'heading' => 'Important Borrowing Caveats & Assumptions',
                'paragraphs' => [
                    "While this {$title} provides mathematically exact amortization calculations based on your inputs, real-world borrowing terms frequently include additional variables. Mortgages often require property taxes, homeowners insurance, private mortgage insurance (PMI), and escrow charges that increase the effective monthly payment beyond principal and interest alone.",
                    'Furthermore, interest rates may be fixed, variable, or hybrid. If you select an adjustable-rate loan, your monthly payment and lifetime borrowing cost may shift significantly over time in response to central bank benchmark rate adjustments.',
                ],
                'key_factors' => [
                    'Property taxes, insurance, and escrow fees are excluded from base principal-and-interest math.',
                    'Variable-rate loans carry interest rate reset risks over multi-year tenures.',
                    'Lender closing fees, points, and administrative charges should be factored into total loan cost.',
                ],
            ],
            'sip', 'compound_interest', 'investment', 'fixed_deposit', 'recurring_deposit' => [
                'heading' => 'Investment Assumptions & Market Realities',
                'paragraphs' => [
                    "This {$title} assumes a constant, annualized rate of return across the entire projection period. In reality, equity and market-linked investments experience non-linear volatility, sequence-of-returns risk, and periodic market corrections.",
                    'Calculations do not automatically deduct capital gains taxes, fund management expense ratios, or inflation drag unless specifically adjusted in your input rate. Factoring in real, after-tax purchasing power provides the most accurate financial guidance.',
                ],
                'key_factors' => [
                    'Projected returns reflect long-term mathematical averages rather than guaranteed annual milestones.',
                    'Inflation reduces future purchasing power; consider using an inflation-adjusted real rate of return.',
                    'Taxes on realized capital gains and investment account maintenance fees impact net realized returns.',
                ],
            ],
            'retirement' => [
                'heading' => 'Long-Term Retirement Planning Variables',
                'paragraphs' => [
                    "Retirement projections span decades and are sensitive to shifting macroeconomic assumptions. Longevity risk, healthcare cost escalation, and inflation rates above baseline projections can alter retirement corpus sustainability.",
                    'It is advisable to stress-test your retirement numbers across varying market cycles and incorporate multiple income streams (pensions, social security, annuities, and investments) for comprehensive financial resilience.',
                ],
                'key_factors' => [
                    'Healthcare and living costs typically rise faster than general consumer price inflation in retirement.',
                    'The sequence of market returns during the initial 5 years of retirement heavily influences portfolio longevity.',
                    'Tax status of retirement withdrawals (pre-tax vs. post-tax accounts) dictates spendable retirement income.',
                ],
            ],
            'income_tax', 'salary', 'take_home_salary', 'hourly_wage' => [
                'heading' => 'Tax & Payroll Calculation Limitations',
                'paragraphs' => [
                    "Taxation systems are governed by detailed statutory codes with numerous individual deductions, regional surcharges, credits, and exemption thresholds. This {$title} uses simplified baseline brackets to provide clear planning estimates.",
                    'The output should not be utilized for official tax filing or binding payroll compliance. Consult certified tax professionals and official government revenue service publications for authoritative individual tax calculations.',
                ],
                'key_factors' => [
                    'State, provincial, or municipal local income taxes vary widely by residential jurisdiction.',
                    'Individual tax credits, itemized deductions, and marital filing status alter effective tax liability.',
                    'Payroll withholdings may include voluntary contributions (health, retirement) not captured in statutory models.',
                ],
            ],
            'sales_tax' => [
                'heading' => 'Indirect Tax Compliance & Variances',
                'paragraphs' => [
                    "Sales tax, VAT, and GST rules vary by product category, digital versus physical goods, and cross-border commercial nexus rules. Certain essential commodities enjoy zero-rated or discounted tax schedules.",
                    'Ensure that you confirm the exact statutory rate applicable to your specific product classification and geographic trading jurisdiction prior to finalizing commercial invoices.',
                ],
                'key_factors' => [
                    'Different product classes (food, medicine, digital services) may qualify for reduced tax tiers.',
                    'B2B transactions frequently allow input tax credit recovery, distinguishing them from final consumer sales.',
                ],
            ],
            'credit_card_interest', 'debt_payoff' => [
                'heading' => 'Debt Structure & Penalty Considerations',
                'paragraphs' => [
                    "This calculator models fixed monthly payments against an existing balance. If new purchases continue to be charged to the account, or if penalty APRs are triggered due to late payments, the payoff timeline and interest charges will increase.",
                    'Always verify whether your credit agreement imposes minimum finance charges or variable APR adjustments pegged to prime rate shifts.',
                ],
                'key_factors' => [
                    'Ongoing card usage extends the debt payoff timeline and increases total interest expense.',
                    'Variable APR terms mean your finance charges can increase if benchmark interest rates rise.',
                ],
            ],
            'crypto_dca', 'crypto_profit' => [
                'heading' => 'Digital Asset Risk & Volatility Warnings',
                'paragraphs' => [
                    'Cryptocurrency assets are subject to extreme market volatility, regulatory changes, liquidity variations, and cybersecurity risks. Historical returns are not indicative of future performance.',
                    'Ensure that cryptocurrency allocations remain aligned with your personal risk tolerance, and maintain appropriate cold-storage security and tax compliance practices.',
                ],
                'key_factors' => [
                    'Digital asset markets operate 24/7 without circuit breakers and can experience rapid drawdown cycles.',
                    'Every crypto-to-crypto and crypto-to-fiat disposal event may constitute a taxable capital gains transaction.',
                ],
            ],
            'budget', 'expense' => [
                'heading' => 'Cash Flow Accuracy & Sinking Fund Management',
                'paragraphs' => [
                    'A monthly budget is only as accurate as the granularity of its tracked expenses. Overlooking periodic or annual costs (vehicle repairs, seasonal utility spikes, annual subscriptions) is the leading cause of budget deviation.',
                    'Incorporate a dedicated sinking fund line item to absorb predictable non-monthly expenses without disrupting your core monthly savings progress.',
                ],
                'key_factors' => [
                    'Irregular annual expenses must be amortized into monthly savings allocations.',
                    'Maintain emergency liquidity equivalent to 3–6 months of essential living expenses.',
                ],
            ],
            default => [
                'heading' => 'General Financial Calculation Considerations',
                'paragraphs' => [
                    "This calculator provides educational estimates designed for preliminary planning and scenario analysis. Financial outcomes in practice are influenced by individual contractual terms, institutional fees, tax obligations, and market changes.",
                    'Verify all critical financial calculations with licensed advisers, institutional documentation, and qualified legal or tax professionals before executing binding agreements.',
                ],
                'key_factors' => [
                    'Calculations are mathematical models based on user-supplied variables.',
                    'Real-world results may vary due to fees, taxes, and contractual specifics.',
                ],
            ],
        };
    }

    protected static function categoryFramework(array $category): array
    {
        return match ($category['slug']) {
            'loan-calculators' => [
                'Borrowing decisions require evaluating both monthly cash-flow commitments and the total lifetime cost of capital. An attractive monthly payment can obscure substantial cumulative interest charges if achieved solely through extended loan duration.',
                'Our loan calculators provide standardized amortization modeling for mortgages, auto loans, personal financing, and equated monthly installments (EMI). By holding loan amounts constant while adjusting tenures and rates, you can identify the optimal borrowing structure before engaging with financial institutions.',
            ],
            'investment-calculators' => [
                'Long-term capital growth is governed by the mathematics of compound interest, contribution frequency, and investment duration. Early contributions exert a disproportionately large impact on final portfolio value due to the extended compounding runway.',
                'Use these investment calculators to project wealth accumulation across lump-sum investments, systematic investment plans (SIP), fixed deposits, and multi-decade retirement nest eggs. Comparing conservative and optimistic scenarios helps establish robust, attainable financial goals.',
            ],
            'tax-calculators' => [
                'Taxation represents a significant friction on gross income and business revenue. Differentiating between marginal tax brackets, effective tax rates, and indirect consumption taxes (VAT/GST) is essential for accurate financial planning.',
                'Our tax tools simplify complex rate structures into actionable net figures. Whether extracting tax from gross invoices or estimating annual take-home earnings across progressive income tiers, these models provide a clear baseline for decision-making.',
            ],
            'salary-calculators' => [
                'Evaluating career opportunities and compensation adjustments requires translating headline salary figures into actual spendable monthly cash flow after mandatory deductions and progressive tax withholdings.',
                'These salary and wage calculators enable seamless conversion between hourly rates, monthly pay, and annual gross compensation, providing clear insight into true net earnings before accepting employment offers or relocating.',
            ],
            'credit-calculators' => [
                'High-interest revolving debt can compound rapidly, consuming discretionary cash flow and extending financial vulnerability. Systematic repayment strategies and strict borrowing capacity limits are vital for debt elimination.',
                'Our credit and debt calculators model accelerated payoff timelines, compare interest reduction methodologies, and estimate institutional debt-to-income eligibility thresholds to keep borrowing safe and sustainable.',
            ],
            'crypto-calculators' => [
                'Digital asset markets present elevated volatility, requiring disciplined position sizing and systematic capital allocation rather than emotional market timing.',
                'These cryptocurrency tools model dollar-cost averaging (DCA) strategies and calculate realized returns and cost basis, helping investors evaluate digital asset exposure within a structured risk framework.',
            ],
            'budget-calculators' => [
                'Sustainable wealth accumulation depends upon consistent, disciplined monthly cash flow management. Clear categorization of fixed obligations versus flexible spending enables proactive savings allocation.',
                'Our budgeting tools provide structured frameworks to analyze income, living expenses, and target savings rates, transforming raw financial data into an actionable monthly household operating plan.',
            ],
            default => [
                'Financial planning requires evaluating trade-offs across multiple interconnected variables. Clear mathematical models help turn complex money questions into structured, confident decisions.',
            ],
        };
    }

    protected static function categoryPlanningPoints(array $category): array
    {
        return match ($category['slug']) {
            'loan-calculators' => [
                'Compare monthly affordability against lifetime interest cost across multiple loan durations.',
                'Evaluate how down payments reduce borrowing requirements and lower overall debt service pressure.',
                'Review full amortization schedules to understand how interest front-loading operates.',
            ],
            'investment-calculators' => [
                'Separate capital contributions from compounding returns to measure organic portfolio growth.',
                'Test inflation-adjusted real rates of return to evaluate future purchasing power accurately.',
                'Prioritize investment duration and contribution consistency over chasing speculative high yields.',
            ],
            'tax-calculators' => [
                'Differentiate between marginal and effective tax rates when evaluating incremental income.',
                'Verify tax-inclusive versus tax-exclusive price structures when auditing commercial invoices.',
                'Treat calculations as educational planning baselines before formal filing with revenue authorities.',
            ],
            'salary-calculators' => [
                'Convert gross compensation into realistic net take-home earnings after standard deductions.',
                'Compare hourly wage equivalents against annual fixed salaries for consulting or freelance roles.',
                'Structure household budgets around guaranteed net income rather than variable bonuses.',
            ],
            'credit-calculators' => [
                'Calculate the true cost of minimum payments versus committed fixed extra monthly paydowns.',
                'Keep total monthly debt service obligations below recommended Debt-to-Income (DTI) thresholds.',
                'Focus on eliminating highest-interest balances first to minimize cumulative finance charges.',
            ],
            'crypto-calculators' => [
                'Use recurring dollar-cost averaging to smooth entry costs across volatile market cycles.',
                'Size digital asset positions in proportion to total diversified liquid net worth.',
                'Track cost basis and transaction dates for rigorous capital gains tax accounting.',
            ],
            'budget-calculators' => [
                'Structure income according to essential needs, discretionary wants, and committed savings.',
                'Establish an emergency reserve fund covering 3–6 months of non-negotiable living expenses.',
                'Amortize irregular annual expenses into monthly sinking funds to prevent cash-flow shocks.',
            ],
            default => [
                'Test multiple scenarios to identify key financial sensitivities.',
                'Balance short-term cash flow with long-term capital preservation.',
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

<?php

namespace App\Services\Calculators;

use App\Support\CalculatorCatalog;
use App\Support\CountryContext;

class CalculatorService
{
    public function __construct(
        protected FinancialFormulaService $formulas,
        protected CountryTaxService $countryTaxService,
        protected CountryContext $countryContext
    ) {}

    public function calculate(string $slug, array $input): array
    {
        $calculator = CalculatorCatalog::find($slug);

        abort_unless($calculator, 404);

        return match ($calculator['type']) {
            'amortized_loan' => $this->calculateAmortizedLoan($calculator, $input),
            'mortgage' => $this->calculateMortgage($calculator, $input),
            'sip' => $this->calculateSip($calculator, $input),
            'compound_interest' => $this->calculateCompoundInterest($calculator, $input),
            'investment' => $this->calculateInvestment($calculator, $input),
            'retirement' => $this->calculateRetirement($calculator, $input),
            'fixed_deposit' => $this->calculateFixedDeposit($calculator, $input),
            'recurring_deposit' => $this->calculateRecurringDeposit($calculator, $input),
            'income_tax' => $this->calculateIncomeTax($calculator, $input),
            'salary' => $this->calculateSalary($calculator, $input),
            'take_home_salary' => $this->calculateTakeHomeSalary($calculator, $input),
            'hourly_wage' => $this->calculateHourlyWage($calculator, $input),
            'sales_tax' => $this->calculateSalesTax($calculator, $input),
            'credit_card_interest', 'debt_payoff' => $this->calculateDebtPayoff($calculator, $input),
            'loan_eligibility' => $this->calculateLoanEligibility($calculator, $input),
            'budget' => $this->calculateBudget($calculator, $input),
            'expense' => $this->calculateExpense($calculator, $input),
            'currency_converter' => $this->calculateCurrencyConverter($calculator, $input),
            default => [],
        };
    }

    protected function calculateAmortizedLoan(array $calculator, array $input): array
    {
        $months = $input['tenure_type'] === 'years'
            ? (int) round($input['tenure'] * 12)
            : (int) round($input['tenure']);

        $monthlyPayment = $this->formulas->amortizedPayment($input['principal'], $input['rate'], $months);
        $totalPayment = $monthlyPayment * $months;
        $totalInterest = $totalPayment - $input['principal'];
        $schedule = $this->formulas->amortizationSchedule($input['principal'], $input['rate'], $months, $monthlyPayment);

        return [
            'headline' => 'Your estimated monthly payment is '.$this->money($monthlyPayment).'.',
            'summary' => [
                ['label' => 'Monthly payment', 'value' => $this->money($monthlyPayment)],
                ['label' => 'Total interest', 'value' => $this->money($totalInterest)],
                ['label' => 'Total repayment', 'value' => $this->money($totalPayment)],
            ],
            'details' => [
                ['label' => 'Principal', 'value' => $this->money($input['principal'])],
                ['label' => 'Interest rate', 'value' => $this->percent($input['rate'])],
                ['label' => 'Repayment term', 'value' => $months.' months'],
            ],
            'explanation' => 'This estimate assumes a fixed rate and equal monthly payments throughout the selected loan term.',
            'chart' => $this->breakdownChart([
                'Principal' => $input['principal'],
                'Interest' => $totalInterest,
            ]),
            'schedule' => $this->formatSchedule($schedule),
        ];
    }

    protected function calculateMortgage(array $calculator, array $input): array
    {
        $loanAmount = max(0, $input['home_price'] - $input['down_payment']);
        $months = (int) round($input['loan_term_years'] * 12);
        $monthlyPayment = $this->formulas->amortizedPayment($loanAmount, $input['rate'], $months);
        $totalPayment = $monthlyPayment * $months;
        $totalInterest = $totalPayment - $loanAmount;
        $schedule = $this->formulas->amortizationSchedule($loanAmount, $input['rate'], $months, $monthlyPayment);

        return [
            'headline' => 'Your estimated monthly principal-and-interest payment is '.$this->money($monthlyPayment).'.',
            'summary' => [
                ['label' => 'Loan amount', 'value' => $this->money($loanAmount)],
                ['label' => 'Monthly mortgage', 'value' => $this->money($monthlyPayment)],
                ['label' => 'Total interest', 'value' => $this->money($totalInterest)],
                ['label' => 'Total repayment', 'value' => $this->money($totalPayment)],
            ],
            'details' => [
                ['label' => 'Home price', 'value' => $this->money($input['home_price'])],
                ['label' => 'Down payment', 'value' => $this->money($input['down_payment'])],
                ['label' => 'Loan term', 'value' => $input['loan_term_years'].' years'],
            ],
            'explanation' => 'This mortgage estimate focuses on principal and interest only, making it globally reusable across markets with different tax and insurance structures.',
            'chart' => $this->breakdownChart([
                'Down payment' => $input['down_payment'],
                'Loan principal' => $loanAmount,
                'Interest' => $totalInterest,
            ]),
            'schedule' => $this->formatSchedule($schedule),
        ];
    }

    protected function calculateSip(array $calculator, array $input): array
    {
        $months = (int) round($input['years'] * 12);
        $futureValue = $this->formulas->futureValueSeries($input['monthly_investment'], $input['rate'], $months);
        $invested = $input['monthly_investment'] * $months;
        $returns = $futureValue - $invested;

        return [
            'headline' => 'At this pace, your investment could grow to about '.$this->money($futureValue).'.',
            'summary' => [
                ['label' => 'Maturity value', 'value' => $this->money($futureValue)],
                ['label' => 'Total invested', 'value' => $this->money($invested)],
                ['label' => 'Estimated returns', 'value' => $this->money($returns)],
            ],
            'details' => [
                ['label' => 'Monthly investment', 'value' => $this->money($input['monthly_investment'])],
                ['label' => 'Expected return', 'value' => $this->percent($input['rate'])],
                ['label' => 'Period', 'value' => $input['years'].' years'],
            ],
            'explanation' => 'The result assumes your contribution is invested every month and earns a steady annualized return throughout the period.',
        ];
    }

    protected function calculateCompoundInterest(array $calculator, array $input): array
    {
        $futureValue = $this->formulas->futureValueLumpSum(
            $input['principal'],
            $input['rate'],
            (int) $input['frequency'],
            $input['years']
        );

        return [
            'headline' => 'Your lump-sum amount could grow to '.$this->money($futureValue).' over the selected period.',
            'summary' => [
                ['label' => 'Final amount', 'value' => $this->money($futureValue)],
                ['label' => 'Interest earned', 'value' => $this->money($futureValue - $input['principal'])],
                ['label' => 'Initial amount', 'value' => $this->money($input['principal'])],
            ],
            'details' => [
                ['label' => 'Annual rate', 'value' => $this->percent($input['rate'])],
                ['label' => 'Compounding frequency', 'value' => $this->frequencyLabel((int) $input['frequency'])],
                ['label' => 'Time period', 'value' => $input['years'].' years'],
            ],
            'explanation' => 'Compound growth accelerates over time because each period adds returns on both the initial amount and previously earned interest.',
        ];
    }

    protected function calculateInvestment(array $calculator, array $input): array
    {
        $months = (int) round($input['years'] * 12);
        $futurePrincipal = $this->formulas->futureValueLumpSum($input['initial_investment'], $input['rate'], 12, $input['years']);
        $futureContributions = $this->formulas->futureValueSeries($input['monthly_contribution'], $input['rate'], $months);
        $futureValue = $futurePrincipal + $futureContributions;
        $totalContributions = $input['initial_investment'] + ($input['monthly_contribution'] * $months);

        return [
            'headline' => 'Your plan could grow to approximately '.$this->money($futureValue).'.',
            'summary' => [
                ['label' => 'Future value', 'value' => $this->money($futureValue)],
                ['label' => 'Total contributed', 'value' => $this->money($totalContributions)],
                ['label' => 'Estimated growth', 'value' => $this->money($futureValue - $totalContributions)],
            ],
            'details' => [
                ['label' => 'Initial amount', 'value' => $this->money($input['initial_investment'])],
                ['label' => 'Monthly contribution', 'value' => $this->money($input['monthly_contribution'])],
                ['label' => 'Expected return', 'value' => $this->percent($input['rate'])],
            ],
            'explanation' => 'This estimate combines compounding on your starting balance and recurring monthly contributions to show the long-term trajectory.',
        ];
    }

    protected function calculateRetirement(array $calculator, array $input): array
    {
        $years = max(0, $input['retirement_age'] - $input['current_age']);
        $months = $years * 12;
        $futureCurrentSavings = $this->formulas->futureValueLumpSum($input['current_savings'], $input['rate'], 12, $years);
        $futureContributions = $this->formulas->futureValueSeries($input['monthly_savings'], $input['rate'], $months);
        $corpus = $futureCurrentSavings + $futureContributions;

        return [
            'headline' => 'By age '.$input['retirement_age'].', your retirement savings could reach about '.$this->money($corpus).'.',
            'summary' => [
                ['label' => 'Projected retirement corpus', 'value' => $this->money($corpus)],
                ['label' => 'Years to retirement', 'value' => (string) $years],
                ['label' => 'Monthly savings', 'value' => $this->money($input['monthly_savings'])],
            ],
            'details' => [
                ['label' => 'Current savings', 'value' => $this->money($input['current_savings'])],
                ['label' => 'Expected return', 'value' => $this->percent($input['rate'])],
                ['label' => 'Retirement age', 'value' => (string) $input['retirement_age']],
            ],
            'explanation' => 'The projection assumes steady monthly contributions and a consistent annualized return until your chosen retirement age.',
        ];
    }

    protected function calculateFixedDeposit(array $calculator, array $input): array
    {
        $maturity = $this->formulas->futureValueLumpSum($input['principal'], $input['rate'], 4, $input['years']);

        return [
            'headline' => 'Your deposit could mature to about '.$this->money($maturity).'.',
            'summary' => [
                ['label' => 'Maturity value', 'value' => $this->money($maturity)],
                ['label' => 'Interest earned', 'value' => $this->money($maturity - $input['principal'])],
                ['label' => 'Deposit amount', 'value' => $this->money($input['principal'])],
            ],
            'details' => [
                ['label' => 'Annual rate', 'value' => $this->percent($input['rate'])],
                ['label' => 'Tenure', 'value' => $input['years'].' years'],
                ['label' => 'Compounding', 'value' => 'Quarterly'],
            ],
            'explanation' => 'This estimate assumes a one-time deposit that compounds quarterly over the selected term.',
        ];
    }

    protected function calculateRecurringDeposit(array $calculator, array $input): array
    {
        $months = (int) round($input['years'] * 12);
        $maturity = $this->formulas->futureValueSeries($input['monthly_investment'], $input['rate'], $months);
        $deposited = $input['monthly_investment'] * $months;

        return [
            'headline' => 'Your recurring deposits could grow to about '.$this->money($maturity).'.',
            'summary' => [
                ['label' => 'Maturity value', 'value' => $this->money($maturity)],
                ['label' => 'Total deposited', 'value' => $this->money($deposited)],
                ['label' => 'Interest earned', 'value' => $this->money($maturity - $deposited)],
            ],
            'details' => [
                ['label' => 'Monthly deposit', 'value' => $this->money($input['monthly_investment'])],
                ['label' => 'Annual rate', 'value' => $this->percent($input['rate'])],
                ['label' => 'Tenure', 'value' => $input['years'].' years'],
            ],
            'explanation' => 'The recurring deposit estimate assumes monthly deposits and a steady return across the full savings period.',
        ];
    }

    protected function calculateIncomeTax(array $calculator, array $input): array
    {
        $taxData = $this->countryTaxService->calculateIncomeTax(
            $input['country'],
            $input['annual_income'],
            $input['deductions'],
            $input['filing_status']
        );
        $taxableIncome = max(0, $input['annual_income'] - $input['deductions']);
        $netIncome = $input['annual_income'] - $taxData['tax'];

        return [
            'headline' => 'For '.$taxData['country'].', your estimated annual tax is '.$this->money($taxData['tax']).', leaving roughly '.$this->money($netIncome).' after tax.',
            'summary' => [
                ['label' => 'Estimated annual tax', 'value' => $this->money($taxData['tax'])],
                ['label' => 'Net annual income', 'value' => $this->money($netIncome)],
                ['label' => 'Effective tax rate', 'value' => $this->percent($taxData['effective_tax_rate'])],
            ],
            'details' => [
                ['label' => 'Tax model', 'value' => $taxData['country']],
                ['label' => 'Annual income', 'value' => $this->money($input['annual_income'])],
                ['label' => 'Deductions', 'value' => $this->money($input['deductions'])],
                ['label' => 'Taxable income', 'value' => $this->money($taxableIncome)],
            ],
            'explanation' => $taxData['explanation'],
            'chart' => $this->breakdownChart([
                'Net income' => $netIncome,
                'Tax' => $taxData['tax'],
            ]),
        ];
    }

    protected function calculateSalary(array $calculator, array $input): array
    {
        $annual = $input['hourly_rate'] * $input['hours_per_week'] * $input['weeks_per_year'];

        return [
            'headline' => 'At this rate and schedule, your gross annual salary is about '.$this->money($annual).'.',
            'summary' => [
                ['label' => 'Annual gross salary', 'value' => $this->money($annual)],
                ['label' => 'Monthly gross salary', 'value' => $this->money($annual / 12)],
                ['label' => 'Weekly gross salary', 'value' => $this->money($annual / $input['weeks_per_year'])],
                ['label' => 'Daily gross salary', 'value' => $this->money($annual / ($input['weeks_per_year'] * 5))],
            ],
            'details' => [
                ['label' => 'Hourly rate', 'value' => $this->money($input['hourly_rate'])],
                ['label' => 'Hours per week', 'value' => number_format($input['hours_per_week'], 1)],
                ['label' => 'Weeks worked', 'value' => (string) $input['weeks_per_year']],
            ],
            'explanation' => 'This gross pay estimate is based on a stable hourly rate and regular working schedule across the year.',
        ];
    }

    protected function calculateTakeHomeSalary(array $calculator, array $input): array
    {
        $takeHome = $this->countryTaxService->calculateTakeHome(
            $input['country'],
            $input['annual_salary'],
            $input['other_deductions'],
            $input['filing_status']
        );
        $net = $takeHome['net_annual'];

        return [
            'headline' => 'Your estimated annual take-home pay is '.$this->money($net).'.',
            'summary' => [
                ['label' => 'Net annual salary', 'value' => $this->money($net)],
                ['label' => 'Net monthly salary', 'value' => $this->money($net / 12)],
                ['label' => 'Estimated tax', 'value' => $this->money($takeHome['tax'])],
                ['label' => 'Payroll / social contributions', 'value' => $this->money($takeHome['social_contributions'])],
            ],
            'details' => [
                ['label' => 'Country model', 'value' => $takeHome['country']],
                ['label' => 'Gross annual salary', 'value' => $this->money($input['annual_salary'])],
                ['label' => 'Other deductions', 'value' => $this->money($input['other_deductions'])],
                ['label' => 'Net ratio', 'value' => $this->percent(($net / $input['annual_salary']) * 100)],
            ],
            'explanation' => $takeHome['explanation'],
            'chart' => $this->breakdownChart([
                'Net pay' => $net,
                'Income tax' => $takeHome['tax'],
                'Payroll deductions' => $takeHome['social_contributions'],
                'Other deductions' => $input['other_deductions'],
            ]),
        ];
    }

    protected function calculateHourlyWage(array $calculator, array $input): array
    {
        $hours = $input['hours_per_week'] * $input['weeks_per_year'];
        $hourly = $hours > 0 ? $input['annual_salary'] / $hours : 0;

        return [
            'headline' => 'Your implied hourly wage is about '.$this->money($hourly).'.',
            'summary' => [
                ['label' => 'Hourly wage', 'value' => $this->money($hourly)],
                ['label' => 'Weekly salary', 'value' => $this->money($input['annual_salary'] / $input['weeks_per_year'])],
                ['label' => 'Monthly salary', 'value' => $this->money($input['annual_salary'] / 12)],
            ],
            'details' => [
                ['label' => 'Annual salary', 'value' => $this->money($input['annual_salary'])],
                ['label' => 'Hours per week', 'value' => number_format($input['hours_per_week'], 1)],
                ['label' => 'Weeks worked', 'value' => (string) $input['weeks_per_year']],
            ],
            'explanation' => 'This calculation divides annual salary by your total working hours across the year to show an implied hourly rate.',
        ];
    }

    protected function calculateSalesTax(array $calculator, array $input): array
    {
        if ($input['tax_mode'] === 'exclusive') {
            $tax = $input['amount'] * ($input['tax_rate'] / 100);
            $net = $input['amount'];
            $gross = $input['amount'] + $tax;
        } else {
            $gross = $input['amount'];
            $net = $input['amount'] / (1 + ($input['tax_rate'] / 100));
            $tax = $gross - $net;
        }

        return [
            'headline' => 'The estimated tax amount is '.$this->money($tax).'.',
            'summary' => [
                ['label' => 'Tax amount', 'value' => $this->money($tax)],
                ['label' => 'Pre-tax amount', 'value' => $this->money($net)],
                ['label' => 'Post-tax amount', 'value' => $this->money($gross)],
            ],
            'details' => [
                ['label' => 'Tax rate', 'value' => $this->percent($input['tax_rate'])],
                ['label' => 'Pricing mode', 'value' => ucfirst($input['tax_mode'])],
                ['label' => 'Entered amount', 'value' => $this->money($input['amount'])],
            ],
            'explanation' => 'Use exclusive mode when the amount entered does not yet include tax, and inclusive mode when the amount already includes tax.',
        ];
    }

    protected function calculateDebtPayoff(array $calculator, array $input): array
    {
        $result = $this->formulas->debtPayoff($input['balance'], $input['rate'], $input['monthly_payment']);

        if ($result['warning']) {
            return [
                'headline' => $result['warning'],
                'summary' => [
                    ['label' => 'Outstanding balance', 'value' => $this->money($input['balance'])],
                    ['label' => 'APR', 'value' => $this->percent($input['rate'])],
                    ['label' => 'Monthly payment', 'value' => $this->money($input['monthly_payment'])],
                ],
                'details' => [],
                'explanation' => 'Increase the monthly payment so it exceeds the monthly interest charge and the balance can start shrinking.',
                'warning' => true,
            ];
        }

        return [
            'headline' => 'At this payment level, the balance could be cleared in about '.$result['months'].' months.',
            'summary' => [
                ['label' => 'Payoff time', 'value' => $result['months'].' months'],
                ['label' => 'Total interest', 'value' => $this->money($result['interest'])],
                ['label' => 'Total paid', 'value' => $this->money($result['total_paid'])],
            ],
            'details' => [
                ['label' => 'Starting balance', 'value' => $this->money($input['balance'])],
                ['label' => 'APR', 'value' => $this->percent($input['rate'])],
                ['label' => 'Monthly payment', 'value' => $this->money($input['monthly_payment'])],
            ],
            'explanation' => 'The estimate assumes a fixed monthly payment and a constant rate, with interest added each month to the remaining balance.',
        ];
    }

    protected function calculateLoanEligibility(array $calculator, array $input): array
    {
        $maxDebtRatio = 0.4;
        $availablePayment = max(0, ($input['monthly_income'] * $maxDebtRatio) - $input['monthly_obligations']);
        $months = $input['term_years'] * 12;
        $monthlyRate = $input['rate'] / 1200;

        if ($availablePayment <= 0) {
            return [
                'headline' => 'There is no remaining monthly payment capacity under this affordability model.',
                'summary' => [
                    ['label' => 'Income cap for debt', 'value' => $this->money($input['monthly_income'] * $maxDebtRatio)],
                    ['label' => 'Existing obligations', 'value' => $this->money($input['monthly_obligations'])],
                    ['label' => 'Available payment', 'value' => $this->money(0)],
                ],
                'details' => [],
                'explanation' => 'This simplified model assumes up to 40% of gross monthly income can be allocated to debt obligations.',
                'warning' => true,
            ];
        }

        $eligibleLoan = $monthlyRate == 0.0
            ? $availablePayment * $months
            : $availablePayment * ((((1 + $monthlyRate) ** $months) - 1) / ($monthlyRate * ((1 + $monthlyRate) ** $months)));

        return [
            'headline' => 'Based on these assumptions, the estimated loan amount could be around '.$this->money($eligibleLoan).'.',
            'summary' => [
                ['label' => 'Estimated loan eligibility', 'value' => $this->money($eligibleLoan)],
                ['label' => 'Available monthly payment', 'value' => $this->money($availablePayment)],
                ['label' => 'Debt-to-income ratio used', 'value' => '40%'],
            ],
            'details' => [
                ['label' => 'Monthly income', 'value' => $this->money($input['monthly_income'])],
                ['label' => 'Existing obligations', 'value' => $this->money($input['monthly_obligations'])],
                ['label' => 'Loan term', 'value' => $input['term_years'].' years'],
            ],
            'explanation' => 'This is a planning benchmark rather than lender underwriting. Real approvals may use stricter income verification and risk checks.',
        ];
    }

    protected function calculateBudget(array $calculator, array $input): array
    {
        $expenses = collect(['housing', 'food', 'transport', 'utilities', 'healthcare', 'other'])
            ->mapWithKeys(fn (string $key) => [$key => (float) $input[$key]]);
        $totalExpenses = $expenses->sum();
        $surplus = $input['income'] - $totalExpenses;
        $largestCategory = $expenses->sortDesc()->keys()->first();

        return [
            'headline' => 'Your estimated monthly surplus is '.$this->money($surplus).'.',
            'summary' => [
                ['label' => 'Monthly income', 'value' => $this->money($input['income'])],
                ['label' => 'Total expenses', 'value' => $this->money($totalExpenses)],
                ['label' => 'Monthly surplus', 'value' => $this->money($surplus)],
                ['label' => 'Savings rate', 'value' => $this->percent($input['income'] > 0 ? ($surplus / $input['income']) * 100 : 0)],
            ],
            'details' => [
                ['label' => 'Largest expense category', 'value' => ucfirst($largestCategory)],
                ['label' => 'Largest category cost', 'value' => $this->money($expenses[$largestCategory])],
                ['label' => 'Expense ratio', 'value' => $this->percent(($totalExpenses / $input['income']) * 100)],
            ],
            'explanation' => 'This monthly budget view is designed to help you quickly compare income against recurring spending categories and spot room for improvement.',
        ];
    }

    protected function calculateExpense(array $calculator, array $input): array
    {
        $expenses = collect(['housing', 'food', 'transport', 'utilities', 'healthcare', 'other'])
            ->mapWithKeys(fn (string $key) => [$key => (float) $input[$key]]);
        $total = $expenses->sum();
        $largestCategory = $expenses->sortDesc()->keys()->first();

        return [
            'headline' => 'Your tracked monthly expenses total '.$this->money($total).'.',
            'summary' => [
                ['label' => 'Total expenses', 'value' => $this->money($total)],
                ['label' => 'Largest category', 'value' => ucfirst($largestCategory)],
                ['label' => 'Largest category amount', 'value' => $this->money($expenses[$largestCategory])],
            ],
            'details' => $expenses->map(fn (float $amount, string $category) => [
                'label' => ucfirst($category),
                'value' => $this->money($amount),
            ])->values()->all(),
            'explanation' => 'Tracking spending in a few consistent categories makes it easier to benchmark where your money goes each month.',
        ];
    }

    protected function calculateCurrencyConverter(array $calculator, array $input): array
    {
        $converted = $input['amount'] * $input['exchange_rate'];

        return [
            'headline' => $this->money($input['amount']).' '.$input['from_currency'].' converts to about '.$this->money($converted).' '.$input['to_currency'].'.',
            'summary' => [
                ['label' => 'Converted amount', 'value' => $this->money($converted).' '.$input['to_currency']],
                ['label' => 'Source amount', 'value' => $this->money($input['amount']).' '.$input['from_currency']],
                ['label' => 'Exchange rate', 'value' => number_format($input['exchange_rate'], 4)],
            ],
            'details' => [
                ['label' => 'From currency', 'value' => $input['from_currency']],
                ['label' => 'To currency', 'value' => $input['to_currency']],
                ['label' => 'Rate basis', 'value' => 'Manual input'],
            ],
            'explanation' => 'This first-phase currency converter uses a manual rate so the page remains functional before live FX integrations are added.',
        ];
    }

    protected function breakdownChart(array $segments): array
    {
        $palette = ['#67e8f9', '#38bdf8', '#818cf8', '#34d399', '#fbbf24'];
        $total = max(0.01, array_sum($segments));

        return [
            'segments' => collect($segments)->values()->map(function (float $value, int $index) use ($segments, $palette, $total) {
                $label = array_keys($segments)[$index];

                return [
                    'label' => $label,
                    'value' => $this->money($value),
                    'percent' => round(($value / $total) * 100, 1),
                    'color' => $palette[$index % count($palette)],
                ];
            })->all(),
        ];
    }

    protected function formatSchedule(array $schedule): array
    {
        $sample = collect($schedule)
            ->take(12)
            ->push(...collect($schedule)->slice(-1)->all())
            ->unique('month')
            ->values();

        return [
            'columns' => ['Month', 'Payment', 'Principal', 'Interest', 'Balance'],
            'rows' => $sample->map(fn (array $row) => [
                $row['month'],
                $this->money($row['payment']),
                $this->money($row['principal']),
                $this->money($row['interest']),
                $this->money($row['balance']),
            ])->all(),
            'summary' => 'Showing the first 12 months and the final payoff row so users can see how the balance declines over time.',
        ];
    }

    protected function money(float $value): string
    {
        return $this->countryContext->formatCurrency($value);
    }

    protected function percent(float $value): string
    {
        return number_format($value, 2).'%';
    }

    protected function frequencyLabel(int $frequency): string
    {
        return match ($frequency) {
            1 => 'Annually',
            4 => 'Quarterly',
            12 => 'Monthly',
            365 => 'Daily',
            default => $frequency.' times per year',
        };
    }
}
